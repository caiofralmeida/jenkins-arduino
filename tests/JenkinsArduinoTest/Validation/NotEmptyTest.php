<?php

namespace JamalTest\JenkinsArduino\Validation;

use Jamal\JenkinsArduino\Validation\NotEmpty;

class NotEmptyTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function deveMarcarComoInvalidoUmValidoNulo()
    {
        $validator = new NotEmpty('job', null);
        $this->assertFalse($validator->isValid());
    }

    /**
     * @test
     */
    public function deveMarcarComoValidoUmValorStringNomeJob()
    {
        $validator = new NotEmpty('job', 'job-jamal');
        $this->assertTrue($validator->isValid());
    }
}
