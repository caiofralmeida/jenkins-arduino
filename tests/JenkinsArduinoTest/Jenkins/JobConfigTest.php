<?php

namespace JamalTest\JenkinsArduino\Serial;

use Jamal\JenkinsArduino\Jenkins\JobConfig;

class JobConfigTest extends \PHPUnit_Framework_TestCase
{
    public function testConfigurandoJobPortaPadrao()
    {
        $jobConfig = new JobConfig('project-one', 'jenkins.local');

        $this->assertEquals(80, $jobConfig->port);
    }

    public function testConfigurandoJobPortaEspecifica()
    {
        $jobConfig = new JobConfig('project-one', 'jenkins.local', 8180);

        $this->assertEquals(8180, $jobConfig->port);
    }

    public function testGerandoUrlJob()
    {
        $jobConfig = new JobConfig('My-First-Job', 'jenkins.local', 8181);

        $this->assertEquals(
            'http://jenkins.local:8181/job/My-First-Job/lastBuild/api/json',
            $jobConfig->toUrl()
        );
    }

    public function testGerandoUrlJobComCredenciais()
    {
        $credentialsMock = $this->getMock('Jamal\JenkinsArduino\Jenkins\Credentials');
        $credentialsMock->user = 'user';
        $credentialsMock->token = 'password';

        $jobConfig = new JobConfig('My-First-Job', 'jenkins.local', 8181);
        $jobConfig->setCredentials($credentialsMock);

        $this->assertEquals(
            'http://user:password@jenkins.local:8181/job/My-First-Job/lastBuild/api/json',
            $jobConfig->toUrl()
        );
    }
}
