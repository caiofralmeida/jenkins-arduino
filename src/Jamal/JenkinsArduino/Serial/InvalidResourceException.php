<?php

namespace Jamal\JenkinsArduino\Serial;

use InvalidArgumentException;

class InvalidResourceException extends InvalidArgumentException
{
    protected $message = 'Não é um recurso valido';
}
