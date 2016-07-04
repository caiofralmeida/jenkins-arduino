<?php

namespace Jamal\JenkinsArduino;

use Exception;
use Jamal\JenkinsArduino\Jenkins\Client;
use Jamal\JenkinsArduino\Jenkins\JobConfig;
use Jamal\JenkinsArduino\Jenkins\Credentials;
use Jamal\JenkinsArduino\Serial\Writer as SerialWriter;
use Jamal\JenkinsArduino\Serial\Detector;
use Jamal\JenkinsArduino\Jenkins\ArduinoFormatter;
use Jamal\JenkinsArduino\Http\Request;
use Jamal\JenkinsArduino\Validation\NotEmpty;

/**
 * @author Caio Almeida <caioamd@hotmail.com>
 */
class Runner
{
    /**
     * Roda a aplicação
     */
    public static function run()
    {
        $request = new Request();

        $job = $request->get('job');

        $validator = new NotEmpty('job', $job);

        if (!$validator->isValid()) {
            header("HTTP/1.1 422 Unprocessable Entity", true, 422);
            echo $validator->getMessage();
            self::stop();
        }

        $config = self::getConfig();

        $jobConfig = new JobConfig($job, $config['server'], $config['port']);
        $jobConfig->setCredentials(new Credentials());

        $client = new Client();

        $build = $client->doRequest($jobConfig);

        $formatter = new ArduinoFormatter();
        $data = $formatter->format($build);

        $usbDetector = new Detector();
        $usbArduino = $usbDetector->detect($config['serialType'], $config['serialCount']);

        $serialReader = new SerialWriter();
        $serialReader->write($usbArduino, $data);
    }

    /**
     * @return array
     */
    public static function getConfig()
    {
        $path = __DIR__ . '/../../config/production.php';

        if (!is_readable($path)) {
            throw new Exception('O arquivo de configuração production.php não existe!');
        }

        $config = include $path;
        return $config;
    }

    public static function stop()
    {
        die;
    }
}
