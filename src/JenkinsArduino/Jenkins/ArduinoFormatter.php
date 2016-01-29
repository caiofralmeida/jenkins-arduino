<?php

namespace Jamal\JenkinsArduino\Jenkins;

/**
 * @author Caio Almeida <caioamd@hotmail.com>
 */
class ArduinoFormatter
{
    const LIMIT_BYTES = 16;

    /**
     * @param  Build  $build
     * @return string
     */
    public function format(Build $build)
    {
        $firstMessage  = $this->normalizeToLimitBytes($build->getDisplayName());
        $secondMessage = $this->normalizeRunner($build->getActions());

        return sprintf(
            '%d|%s|%s',
            $build->getStatusCode(),
            $firstMessage,
            $secondMessage
        );
    }

    /**
     * @param  string $text
     * @return string
     */
    private function normalizeToLimitBytes($text)
    {
        if (strlen($text) > self::LIMIT_BYTES) {
            return substr($text, -self::LIMIT_BYTES);
        }

        return str_pad($text, self::LIMIT_BYTES, ' ', STR_PAD_RIGHT);
    }

    /**
     * @param  StdClass $actions
     * @return string
     */
    private function normalizeRunner($actions)
    {
        $formatted = '';

        foreach ($actions as $action) {
            if (isset($action->causes)) {
                $cause = $action->causes[0];

                if (isset($cause->userName)) {
                    $formatted = $cause->userName;
                } else {
                    $shortDescription = $cause->shortDescription;
                    $formatted = trim(str_replace('Started by', '', $shortDescription));
                }
            }
        }

        return $this->normalizeToLimitBytes($formatted);
    }
}
