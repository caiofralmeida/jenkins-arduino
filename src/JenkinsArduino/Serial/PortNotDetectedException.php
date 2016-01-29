<?php

namespace Jamal\JenkinsArduino\Serial;

use Exception;

class PortNotDetectedException extends Exception
{
    protected $message = 'Não foi possivel se conectar com arduino via USB';
}
