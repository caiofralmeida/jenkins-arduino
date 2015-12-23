<?php

namespace Jamal\JenkinsArduino\Serial;

/**
 * @author Caio Almeida <caioamd@hotmail.com>
 */
interface Readable
{
    /**
     * @param  resource $resource
     * @return mixed
     */
    public function read($resource);
}
