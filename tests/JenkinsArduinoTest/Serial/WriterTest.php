<?php

namespace JamalTest\JenkinsArduino\Serial;

class WriterTest extends \PHPUnit_Framework_TestCase
{
    protected $writer;

    public function setUp()
    {
        $this->writer = new \Jamal\JenkinsArduino\Serial\Writer();
        chmod($this->getFilePath(), 0055);
    }

    public function testPassandoResourceEscreveNoArquivo()
    {
        $path = __DIR__ . '/../../resource/writertest.txt';
        $data = $this->writer->write($path, 'teste');

        $this->assertNull($data);
    }

    /**
     * @expectedException \Jamal\JenkinsArduino\Serial\CannotWriteException
     */
    public function testRetornandoExcecaoAoNaoConseguirEscreverNoResource()
    {
        $path = __DIR__ . '/../../resource/nopermission.txt';
        $data = $this->writer->write($path, 'teste');
    }

    private function getFilePath()
    {
        return __DIR__ . '/../../resource/nopermission.txt';
    }
}
