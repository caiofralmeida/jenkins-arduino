<?php

namespace JamalTest\JenkinsArduino\Serial;

class ReaderTest extends \PHPUnit_Framework_TestCase
{
    protected $reader;

    public function setUp()
    {
        $this->reader = new \Jamal\JenkinsArduino\Serial\Reader();
    }

    public function testPassandoResourceRetornaDadoLido()
    {
        $path = __DIR__.'/../../../resource/readertest.txt';
        $data = $this->reader->read($path);

        $this->assertEquals("hello world.\n", $data);
    }

    /**
     * @expectedException \Jamal\JenkinsArduino\Serial\InvalidResourceException
     */
    public function testPassandoUmNaoResouceLancaExcecao()
    {
        $this->reader->read(false);
    }
}
