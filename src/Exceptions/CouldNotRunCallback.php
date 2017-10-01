<?php

namespace Periloso\SprinklerNotifications\Exceptions;

use \Exception as Exception;
use \RuntimeException as RuntimeException;

class CouldNotRunCallback extends RuntimeException
{
    /**
     * @param Exception $exception
     * @return static
     */
    public static function runtimeException(Exception $exception)
    {
        return new static("There was an error while executing the required callback: `{$exception->getMessage()}`");
    }
}
