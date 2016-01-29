<?php

namespace Jamal\JenkinsArduino\Serial;

/**
 * @author Caio Almeida <caioamd@hotmail.com>
 * @author Gustavo Lira <gustavolira1506@hotmail.com>
 */
class Reader implements Readable
{
    /**
     * @var string
     */
    const MODE = 'r';

    /**
     * @param  path $path
     * @return mixed
     */
    public function read($path)
    {
        if (!$resource = @fopen($path, self::MODE)) {
            throw new InvalidResourceException();
        }

        $resourceData = stream_get_meta_data($resource);

        return fread($resource, filesize($resourceData['uri']));
    }
}
