package main

import (
	"fmt"
	"log"
	"net/http"
	"strconv"
	"text/template"
)

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

func loadTemplate(w http.ResponseWriter, tpl string, l *List) {
	t, err := template.ParseFiles(tpl + ".html")
	if err != nil {
		http.Error(w, err.Error(), http.StatusInternalServerError)
		return
	}
	t.Execute(w, l)

}
func handler(w http.ResponseWriter, r *http.Request) {
	/*l := &List{
		id: 2,
		Items: []ToDo{
			{Id: 1, Name: "test", Completed: false},
			{Id: 2, Name: "second test", Completed: false},
		},
	}
	*/
	l := &List{id: 1}
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
		default:
			l.add(item)
		}

	}
	templates, err := template.ParseGlob("*.html")
	if err != nil {
		log.Println("The template(s) could not be parsed")
	}
	err = templates.ExecuteTemplate(w, "template.html", l.Items)
	if err != nil {
		http.Error(w, err.Error(), http.StatusInternalServerError)
	}

}

func main() {

	http.HandleFunc("/", handler)
	log.Print("Listening on port 3000")
	log.Fatal(http.ListenAndServe(":3000", nil))
}
