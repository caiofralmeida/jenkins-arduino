<?php

namespace Jamal\JenkinsArduino\Jenkins;

use StdClass;

/**
 * @author Caio Almeida <caioamd@hotmail.com>
 */
class Build
{
    protected $number;

    protected $isBuilding;

    protected $status;

    /**
     * @param array $data
     */
    public function __construct(StdClass $data)
    {
        $this->isBuilding = (boolean) $data->building;
        $this->number     = $data->number;

        if ($data->result == null) {
            $data->result = BuildStatus::BUILDING;
        }

        $this->status     = new BuildStatus($data->result);
    }

    public function getNumber()
    {
        return $this->number;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function getStatusCode()
    {
        return $this->status->getCode();
    }

    public function isBuilding()
    {
        return $this->building;
    }
}
