<?php

namespace Jamal\JenkinsArduino\Jenkins;

use StdClass;

/**
 * @author Caio Almeida <caioamd@hotmail.com>
 * @codeCoverageIgnore
 */
class Build
{
    protected $number;

    protected $isBuilding;

    protected $status;

    protected $displayName;

    protected $actions;

    /**
     * @param array $data
     */
    public function __construct(StdClass $data)
    {
        $this->isBuilding  = (boolean) $data->building;
        $this->number      = $data->number;
        $this->actions     = $data->actions;
        $this->displayName = $data->fullDisplayName;
        $this->status      = new BuildStatus($data->result);
    }

    public function getDisplayName()
    {
        return $this->displayName;
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

    public function getActions()
    {
        return $this->actions;
    }

    public function isBuilding()
    {
        return $this->building;
    }
}
