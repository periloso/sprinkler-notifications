<?php

namespace Periloso\SprinklerNotifications;

use Carbon\Carbon;

class SprinklerMessage
{
    /**
     * Instance attributes
     *
     * @var array
     */
    public $attributes = [
        'to' => null,
        'content' => null,
        'from' => null,
        'device_id' => null,
        'send_at' => null,
        'expires_at' => null,
        'max_retries' => null,
        'callback' => null,

    ];

    /**
     * Create a message
     *
     * @param string $content
     * @return SprinklerMessage
     */
    public static function create($content = '')
    {
        return new static($content);
    }

    /**
     * SprinklerMessage constructor.
     *
     * @param string $content The text content
     */
    public function __construct($content = '')
    {
        return $this->content($content);
    }

    /**
     * The SMS recipient.
     *
     * @param $to
     * @return SprinklerMessage
     */
    public function to($to)
    {
        $this->attributes['to'] = $to;
        return $this;
    }

    /**
     * The text content of the message.
     *
     * @param $content
     * @return SprinklerMessage
     */
    public function content($content)
    {
        $this->attributes['content'] = $content;
        return $this;
    }

    /**
     * Sets the onSuccess callback.
     *
     * @param callable $callback The onSuccess callback.
     * @return SprinklerMessage
     */
    public function onSuccess(callable $callback)
    {
        $this->attributes['callback'] = $callback;
        return $this;
    }

    /**
     * The sender.
     *
     * @param null $from
     * @return SprinklerMessage
     */
    public function from($from = null)
    {
        $this->attributes['from'] = $from;
        return $this;
    }

    /**
     * Sets the device id to send the message from.
     *
     * @param null $device_id
     * @return SprinklerMessage
     */
    public function device($device_id = null)
    {
        $this->attributes['device_id'] = $device_id;
        return $this;
    }

    /**
     * Sets when to send the message.
     *
     * @param Carbon $carbon
     * @return SprinklerMessage
     */
    public function sendAt(Carbon $carbon)
    {
        $this->attributes['send_at'] = $carbon->getTimestamp();;
        return $this;
    }

    /**
     * Sets the maximum number of retries.
     *
     * @param $max
     * @return SprinklerMessage
     */
    public function maxRetries($max)
    {
        $this->attributes['max_restries'] = $max;
        return $this;
    }

    /**
     * Sets when to give up sending the message.
     *
     * @param Carbon $carbon
     * @return SprinklerMessage
     */
    public function expiresAt(Carbon $carbon)
    {
        $this->attributes['expires_at'] = $carbon->getTimestamp();
        return $this;
    }

    /**
     * Converts the message to array.
     *
     * @return array
     */
    public function toArray()
    {
        return [
            'to' => $this->attributes['to'],
            'content' => $this->attributes['content'],
            'from' => $this->attributes['from'],
            'device_id' => $this->attributes['device_id'],
            'send_at' => $this->attributes['send_at'],
            'expires_at' => $this->attributes['expires_at'],
            'max_retries' => $this->attributes['max_restries'],
            'callback' => $this->attributes['callback'],
        ];
    }
}
