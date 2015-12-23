<?php

namespace Jamal\JenkinsArduino\Serial;

/**
 * @author Caio Almeida <caioamd@hotmail.com>
 */
class Manager
{
    protected $reader;
    protected $writer;

    private $resource;

    /**
     * @param SerialReader $reader
     * @param SerialWriter $writer
     */
    public function __construct(Reader $reader, Writer $writer)
    {
        $this->reader = $reader;
        $this->writer = $writer;
    }

    /**
     * @return mixed
     */
    public function read()
    {

    }

    /**
     * @param  string $data
     * @return void
     */
    public function write($data)
    {

    }

    /**
     * @return void
     */
    public function disconnect()
    {
        fclose($this->resource);
    }
}
