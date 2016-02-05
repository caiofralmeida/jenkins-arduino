<?php

namespace Jamal\JenkinsArduino\Jenkins;

/**
 * @author Caio Almeida <caioamd@hotmail.com>
 * @codeCoverageIgnore
 */
class BuildStatus
{
    const BUILDING  = 'BUILDING';
    const SUCCESS   = 'SUCCESS';
    const FAILURE   = 'FAILURE';
    const UNSTABLE  = 'UNSTABLE';
    const ABORTED   = 'ABORTED';

    /**
     * @var string
     */
    protected $status;

    /**
     * @param string $status
     */
    public function __construct($status)
    {
        $this->status = $status;

        if ($this->status == null) {
            $this->status = self::BUILDING;
        }
    }

    /**
     * @return int
     */
    public function getCode()
    {
        $codes = [
            self::BUILDING  => 0,
            self::FAILURE   => 1,
            self::SUCCESS   => 2,
            self::UNSTABLE  => 3,
            self::ABORTED   => 4
        ];

        return $codes[$this->status];
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->status;
    }
}
