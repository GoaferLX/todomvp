<?php
namespace GoaferLX\ToDo;
class ToDo {

    public function __construct(string $item, bool $completed)
    {
        $this->item = $item;
        $this->completed = $completed;
    }

    public function getItem(): string
    {
        return $this->item;
    }

    public function getCompleted(): bool
    {
        return $this->completed;
    }

    public function setCompleted(bool $completed): self
    {
        return new self($this->item, $completed);
    }


}
?>
