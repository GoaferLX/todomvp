<?php
namespace GoaferLX\ToDo;

class ToDoController
{
    public function __construct()
    {
    }

    public function add(ToDoModel $model): ToDoModel
    {
        if(isset($_POST['item'])) {
            $model = $model->add($_POST['item']);
        }
        return $model;
    }
    public function notdone(ToDoModel $model): ToDoModel
    {
        if(isset($_POST['item'])) {
            $model = $model->MarkNotDone($_POST['item']);
        }
        return $model;
    }
    public function done(ToDoModel $model): ToDoModel
    {
        if(isset($_POST['item'])) {
            $model = $model->MarkDone($_POST['item']);
        }
        return $model;
    }
    public function delete(ToDoModel $model): ToDoModel
    {
        if(isset($_POST['item'])) {
              $model = $model->delete($_POST['item']);
        }
        return $model;
    }
}
?>
