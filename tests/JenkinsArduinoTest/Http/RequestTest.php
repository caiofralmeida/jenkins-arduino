<?php

namespace JamalTest\JenkinsArduino\Http;

use Jamal\JenkinsArduino\Http\Request;

class RequestTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function deveRetornarValorNuloQuandoInexistente()
    {
        $request = new Request();
        $this->assertNull($request->get('anything'));
    }

    /**
     * @test
     */
    public function deveRetornarValorQuandoSolicitarValorExistente()
    {
        $_GET['name'] = 'jamal';

        $request = new Request();
        $this->assertEquals('jamal', $request->get('name'));
    }
}
