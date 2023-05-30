<?php

namespace Core\HTML;

class Form
{
    public string $surround = 'field';

    public function __construct()
    {
        $token = uniqid();
        $_SESSION['token'] = $token;
        echo '<input type="hidden" name="token" value="' . $token . '"';
    }

    public function input(string $name, string $type = 'text', string $label = NULL)
    {
        $label = is_null($label) ? ucfirst($name) : ucfirst($label);
        $input = <<< "EOF"
        <div class="$this->surround">
        <label for="$label">$label</label><br>
        <input type="$type" name="$name" id="$label">
        </div>
        EOF;
        echo $input;
    }

    public function textarea(string $name, string $label = NULL)
    {
        $label = is_null($label) ? ucfirst($name) : ucfirst($label);
        $input = <<< "EOF"
        <div class="$this->surround">
        <label for="$label">$label</label><br>
        <textarea name="$name" id="$label"></textarea>
        </div>
        EOF;
        echo $input;
    }

    public function submit(string $value = 'Envoyer')
    {
        echo '<button type="button" class="btn btn-primary">' . $value . '</button>';
    }
}
