package main

import (
	"fmt"
	"log"
	"net/http"
	"text/template"
)

type ToDo struct {
	// id int  // want this later
	Name      string
	Completed bool
}

type List struct {
	Items []ToDo
}

func (l *List) add(name string) {
	l.Items = append(l.Items, ToDo{Name: name, Completed: false})
	fmt.Println("Item added")
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
	}
	err = t.Execute(w, l)
	if err != nil {
		http.Error(w, err.Error(), http.StatusInternalServerError)
	}
}
func handler(w http.ResponseWriter, r *http.Request) {
	l := &List{}
	item := r.FormValue("item")
	if r.URL.Path == "" && r.Method == "POST" {
		l.add(item)
	}

	loadTemplate(w, "template", l)
	fmt.Fprintln(w, "You are on the index page of ToDoMVP")
}

func main() {
	http.HandleFunc("/", handler)
	log.Fatal(http.ListenAndServe(":3000", nil))
}
