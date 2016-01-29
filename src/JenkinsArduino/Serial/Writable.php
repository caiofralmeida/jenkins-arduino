<?php

namespace Jamal\JenkinsArduino\Serial;

/**
 * @author Gustavo Lira <gustavolira1506@hotmail.com>
 * @author Caio Almeida <caioamd@hotmail.com>
 */
interface Writable
{
    /**
     * @param  resource $path
     * @param  string $data
     * @return void
     */
    public function write($path, $data);
}
