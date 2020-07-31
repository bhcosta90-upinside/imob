<?php

namespace App\Support;

class Message
{
    private $text;

    private $type;

    /**
     * @return mixed
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    public function error(string $msg): Message
    {
        $this->type = 'error';
        $this->text = $msg;

        return $this;
    }

    public function success(string $msg): Message
    {
        $this->type = 'success';
        $this->text = $msg;

        return $this;
    }

    public function render(): string
    {
        return "<div class='message {$this->getType()}'>{$this->getText()}</div>";
    }
}
