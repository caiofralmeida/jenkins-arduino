<?php

namespace JamalTest\JenkinsArduino\Serial;

use Jamal\JenkinsArduino\Serial\Detector;

class DetectorTest extends \PHPUnit_Framework_TestCase
{
    protected $detector;

    public function setUp()
    {
        $this->detector = new Detector();
    }

    /**
     * @expectedException \Jamal\JenkinsArduino\Serial\PortNotDetectedException
     * @return [type] [description]
     */
    public function testLancaExcecaoAoNaoEncontrarPortaSerial()
    {
        $type = '/tmp/ttyUSBB';
        $this->detector->detect($type, 5);
    }

    public function testDetectandoPortaSerial()
    {
        $type = __DIR__ . '/../../resource/ttyACM';
        $esperado = $type . '3';

        $this->assertEquals($esperado, $this->detector->detect($type, 5));
    }
}
