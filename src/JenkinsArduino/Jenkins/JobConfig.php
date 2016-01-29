<?php

namespace Jamal\JenkinsArduino\Jenkins;

use StdClass;

/**
 * @author Caio Almeida <caioamd@hotmail.com>
 */
class JobConfig extends StdClass
{
    /**
     * Jenkins server name.
     * @var string
     */
    public $server;

    /**
     * Jenkins port default: 80
     * @var integer
     */
    public $port = 80;

    /**
     * Job name.
     * @var string
     */
    public $jobName;

    /**
     * Http protocol
     * @var string
     */
    public $protocol = 'http';

    /**
     * @var Credentials
     */
    public $credentials;

    /**
     * @param string $jobName
     * @param string $server
     * @param int $port
     */
    public function __construct($jobName, $server, $port = null)
    {
        if (is_integer($port)) {
            $this->port = $port;
        }

        $this->server  = $server;
        $this->jobName = $jobName;
    }

    /**
     * @return string
     */
    public function toUrl()
    {
        $credentials = null;

        if ($this->hasCredentials()) {
            $credentials = sprintf(
                '%s:%s@',
                $this->credentials->user,
                $this->credentials->password
            );
        }

        return strtr(
            '{protocol}://{credentials}{server}:{port}/job/{jobName}/lastBuild/api/json',
            [
                '{protocol}'    => $this->protocol,
                '{server}'      => $this->server,
                '{port}'        => $this->port,
                '{jobName}'     => $this->jobName,
                '{credentials}' => $credentials
            ]
        );
    }

    /**
     * @param Credentials $credentials
     * @return JobConfig
     */
    public function setCredentials(Credentials $credentials)
    {
        $this->credentials = $credentials;
        return $this;
    }

    public function hasCredentials()
    {
        return ($this->credentials instanceof Credentials);
    }
}
