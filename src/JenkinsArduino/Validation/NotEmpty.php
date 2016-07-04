<?php

namespace Jamal\JenkinsArduino\Validation;

class NotEmpty
{
    private $name;
    private $value;

    public function __construct($name, $value)
    {
        $this->name  = $name;
        $this->value = $value;
    }

    public function isValid()
    {
        return (!empty($this->value) && strlen($this->value) > 0);
    }

    public function getMessage()
    {
        return 'O parametro ' . $this->name . ' não foi passado.';
    }
}
