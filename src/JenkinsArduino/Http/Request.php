<?php

namespace Jamal\JenkinsArduino\Http;

class Request
{
    private $container = [];

    public function __construct()
    {
        $this->container = $_GET;
    }

    public function get($key)
    {
        if ($this->exists($key)) {
            return $this->container[$key];
        }
    }

    public function exists($key)
    {
        return isset($this->container[$key]);
    }
}
