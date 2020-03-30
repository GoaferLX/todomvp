package main

import (
	"log"
	"net/http"
	"strconv"
	"text/template"
)

var tpls *template.Template
var err error

type ToDo struct {
	ID        int // want this later
	Name      string
	Completed bool
}

type List struct {
	id    int
	Items []ToDo
}

func (l *List) add(name string) {

	l.Items = append(l.Items, ToDo{ID: l.id, Name: name, Completed: false})
	l.id++
}

func (l *List) delete(id int) {
	var slice []ToDo
	for _, todo := range l.Items {
		if todo.ID != id {
			slice = append(slice, todo)
		}
	}
	l.Items = slice
}

func (l *List) setCompleted(id int) {
	for i, item := range l.Items {
		if item.ID == id {
			l.Items[i].Completed = true
		}
	}
}
func (l *List) setNotCompleted(id int) {
	for i, item := range l.Items {
		if item.ID == id {
			l.Items[i].Completed = false
		}
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
		log.Print("The template(s) could not be parsed")
	}
}
func renderTemplate(w http.ResponseWriter, tplName string, data []ToDo) {
	err := tpls.ExecuteTemplate(w, tplName, data)
	if err != nil {
		log.Printf("Could not execute error: %v", err)
	}

}
func main() {
	//http.HandleFunc("/", handler)
	http.Handle("/", &List{})
	log.Print("Listening on port 3000")
	log.Fatal(http.ListenAndServe(":3000", nil))
}
