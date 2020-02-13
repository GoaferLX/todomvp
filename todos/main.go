Package main
Import (
"fmt"
"http/net"
"Log"
"html/template"
)

type ToDo struct {
// id int
Name string
Completed bool
}

var list map[int]ToDo

func (l *list) add(name string) {
append(l, ToDo{Name: name, Completed: false}
}

func (l *list) delete(id int) {
delete(l, id)
} 
func (l *list) setCompleted(complete bool) {
l[id].Completed = 1
}

func main() {
http.HandleFunc("/", handler)
log.Fatal(http.ListenAndServe("8080", nil))
}
