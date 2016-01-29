<?php

namespace JamalTest\JenkinsArduino\Serial;

use Jamal\JenkinsArduino\Jenkins\BuildStatus;

class BuildStatusTest extends \PHPUnit_Framework_TestCase
{
    public function provedorStatusCode()
    {
        return [
            ['BUILDING',  0],
            ['FAILURE',   1],
            ['SUCCESS',   2],
            ['UNSTABLE',  3],
            ['ABORTED',   4]
        ];
    }

    /**
     * @dataProvider provedorStatusCode
     */
    public function testConversaoDeStatusCode($build, $code)
    {
        $buildStatus = new BuildStatus($build);
        $this->assertEquals($code, $buildStatus->getCode());
    }
}
