<?php

namespace Jamal\JenkinsArduino\Serial;

class CannotWriteException extends \Exception
{
    protected $message = 'Não pode escrever no arquivo';
}
