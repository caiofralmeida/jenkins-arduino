<?php

namespace Jamal\JenkinsArduino;

use Exception;
use Jamal\JenkinsArduino\Jenkins\Client;
use Jamal\JenkinsArduino\Jenkins\JobConfig;
use Jamal\JenkinsArduino\Jenkins\Credentials;
use Jamal\JenkinsArduino\Serial\Writer as SerialWriter;

/**
 * @author Caio Almeida <caioamd@hotmail.com>
 */
class Runner
{
    const JOB_REQUEST = 'job';

    /**
     * Roda a aplicação
     */
    public static function run()
    {
        if (!$job = self::getJobRequest()) {
            die();
        }

        $config = self::getConfig();

        $jobConfig = new JobConfig($job, $config['server'], $config['port']);
        $jobConfig->setCredentials(new Credentials());

        $client = new Client();

        $build = $client->doRequest($jobConfig);

        $serialReader = new SerialWriter();
        $serialReader->write('/dev/ttyACM0', $build->getStatusCode());
    }

    /**
     * @return array
     */
    public static function getConfig()
    {
        $path = __DIR__ . '/../../../config/production.php';

        if (!is_readable($path)) {
            throw new Exception('O arquivo de configuração production.php não existe!');
        }

        $config = include $path;
        return $config;
    }

    /**
     * @return string
     */
    public static function getJobRequest()
    {
        if (isset($_GET[self::JOB_REQUEST])
            && strlen($_GET[self::JOB_REQUEST]) > 0
        ) {
            return $_GET[self::JOB_REQUEST];
        }
    }
}
