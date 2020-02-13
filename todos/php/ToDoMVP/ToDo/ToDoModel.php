<?php
namespace GoaferLX\ToDo;

class ToDoModel {
    private $list;
    private $errors;

    public function __construct(array $list=[],array $errors=[])
    {
      $this->list = $list;
      $this->errors = $errors;
    }

    public function getList(): array
    {
      return $this->list;
    }
    public function getErrors(): array
    {
        return $this->errors;
    }

    public function clean($string): string
    {
      return htmlspecialchars(stripslashes(trim($string)));
    }

    public function validate($field) {
        if(empty($this->clean($field))) {
            $errors[] = 'Entry is invalid!';
            return $errors;
        }
    }

    public function add(string $item): self
    {
      $errors = $this->validate($item);
      if(!empty($errors)) {
        return new self($this->list,$errors);
      }
      $list = $this->list;
      $list[] = new ToDo($this->clean($item), false);
      return new self($list, $this->errors);
    }

    public function markDone(int $num): self
    {
        $list = $this->list;
        $list[$num] = $list[$num]->setCompleted(true);
        return new self($list, $this->errors);
    }

    public function markNotDone(int $num): self
    {
        $list = $this->list;
        $list[$num] = $list[$num]->setCompleted(false);
        return new self($list, $this->errors);
    }

    public function delete(int $num): self
    {
      unset($this->list[$num]);
      return $this;
    }

}
?>
