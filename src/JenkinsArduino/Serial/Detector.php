<?php

namespace Jamal\JenkinsArduino\Serial;

/**
 * @author Caio Almeida <caioamd@hotmail.com>
 */
class Detector
{
    /**
     * @param  string $usbType
     * @param  int $usbCount
     * @return string
     */
    public function detect($usbType, $usbCount)
    {
        for ($i = 0; $i <= $usbCount; $i++) {
            $port = $usbType . $i;
            if (is_readable($port)) {
                return $port;
            }
        }

        throw new PortNotDetectedException();
    }
}
