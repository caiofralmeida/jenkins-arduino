<?php

namespace Jamal\JenkinsArduino\Serial;

/**
 * @author Caio Almeida <caioamd@hotmail.com>
 * @author Gustavo Lira <gustavolira1506@hotmail.com>
 */
class Writer implements Writable
{
 /**
  * @var string
  */
 const MODE = 'w';

 /**
  * @param  string $path
  * @param  mixed $data
  * @return void
  */
 public function write($path, $data)
 {
     if (!$resource = @fopen($path, self::MODE)) {
         throw new CannotWriteException();
     }

     fwrite($resource, $data);
     fclose($resource);
 }
}
