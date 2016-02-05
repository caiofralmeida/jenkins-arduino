<?php

namespace JamalTest\JenkinsArduino\Jenkins;

use Jamal\JenkinsArduino\Jenkins\ArduinoFormatter;

class ArduinoFormatterTest extends \PHPUnit_Framework_TestCase
{
    protected $formatter;

    public function setUp()
    {
        $this->formatter = new ArduinoFormatter();
    }

    public function testPassandoTextoMenor16Bytes()
    {
        echo 'asdas';
        $build = new \Jamal\JenkinsArduino\Jenkins\Build(
        (object)[
            'number' => 1,
            'fullDisplayName' => 'HomoWeb #1',
            'building' => null,
            'result' => null,
            'actions' => [
                0 => (object) [
                    'causes' => [
                        0 => (object) [
                            'shortDescription' => 'run by caio'
                        ]
                    ]
                ]
            ]
        ]);

        $result = $this->formatter->format($build);
        $this->assertEquals('0|HomoWeb #1      |run by caio     ', $result);
    }

    public function testPassandoTextoMaior16Bytes()
    {
        $build = new \Jamal\JenkinsArduino\Jenkins\Build(
        (object)[
            'number' => 1,
            'fullDisplayName' => 'Dev-orionweb-cartao-credito #1',
            'building' => null,
            'result' => null,
            'actions' => [
                0 => (object) [
                    'causes' => [
                        0 => (object) [
                            'shortDescription' => 'Started by an SCM change'
                        ]
                    ]
                ]
            ]
        ]);

        $result = $this->formatter->format($build);
        $this->assertEquals('0|artao-credito #1|an SCM change   ', $result);
    }

    public function testPassandoTextoMenor16BytesComUsuario()
    {
        $build = new \Jamal\JenkinsArduino\Jenkins\Build(
        (object)[
            'number' => 1,
            'fullDisplayName' => 'HomoWeb #1',
            'building' => null,
            'result' => null,
            'actions' => [
                0 => (object) [
                    'causes' => [
                        0 => (object) [
                            'shortDescription' => 'Started by caioalmeida',
                            'userName'         => 'caioalmeida',
                            'userId'           => 1
                        ]
                    ]
                ]
            ]
        ]);

        $result = $this->formatter->format($build);
        $this->assertEquals('0|HomoWeb #1      |caioalmeida     ', $result);
    }
}
