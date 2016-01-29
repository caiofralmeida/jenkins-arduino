<?php

namespace Jamal\JenkinsArduino\Jenkins;

/**
 * @author Caio Almeida <caioamd@hotmail.com>
 */
class Client
{
    /**
     * @param JobConfig $jobConfig
     * @return Build
     */
    public function doRequest(JobConfig $jobConfig)
    {
        $content = json_decode(
            file_get_contents($jobConfig->toUrl())
        );

        return new Build($content);
    }
}
