package main

import (
	"fmt"
	"log"
	"net/http"
	"strconv"
	"text/template"
)

var tpls *template.Template
var err error

type ToDo struct {
	Id        int // want this later
	Name      string
	Completed bool
}

type List struct {
	id    int
	Items []ToDo
}

func (l *List) add(name string) {
	l.Items = append(l.Items, ToDo{Id: l.id, Name: name, Completed: false})
	l.id++
	fmt.Println("Item added, list is now: ", l)
}

func (l *List) delete(id int) {
	l.Items = append(l.Items[:id], l.Items[id+1:]...)
}
func (l *List) setCompleted(id int) {
	l.Items[id].Completed = true
}
func (l *List) setNotCompleted(id int) {
	l.Items[id].Completed = false
}

func renderTemplate(w http.ResponseWriter, tplName string, data []ToDo) {
	err := tpls.ExecuteTemplate(w, tplName, data)
	if err != nil {
		log.Printf("Could not execute error: %v", err)
	}

}
func (l *List) ServeHTTP(w http.ResponseWriter, r *http.Request) {
	if r.Method == "POST" {
		r.ParseForm()
		item := r.FormValue("item")
		id, _ := strconv.Atoi(item)
		switch r.URL.Path {
		case "/done":
			l.setCompleted(id)
		case "/notdone":
			l.setNotCompleted(id)
		case "/delete":
			l.delete(id)
		case "/add":
			l.add(item)
		}

	}
	renderTemplate(w, "template.html", l.Items)

}
func init() {
	tpls, err = template.ParseGlob("*.html")
	if err != nil {
		log.Println("The template(s) could not be parsed")
	}
}

func main() {
	//http.HandleFunc("/", handler)
	http.Handle("/", &List{})
	log.Print("Listening on port 3000")
	log.Fatal(http.ListenAndServe(":3000", nil))
}
