<?php

namespace Periloso\SprinklerNotifications\Exceptions;

use GuzzleHttp\Exception\ClientException;
use \RuntimeException as RuntimeException;

class CouldNotSendNotification extends RuntimeException
{
    /**
     * @param ClientException $exception
     * @return static
     */
    public static function remoteRespondedWithAnError(ClientException $exception)
    {
        $code = $exception->getResponse()->getStatusCode();
        $message = $exception->getResponse()->getBody();
        return new static("Remote server responded with an error `{$code} - {$message}`");
    }

    /**
     * @return static
     */
    public static function couldNotCommunicateWithRemote()
    {
        return new static("Couldn't connect to the remote server API.");
    }
}
