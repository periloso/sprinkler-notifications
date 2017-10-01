<?php

namespace Periloso\SprinklerNotifications;

class SprinklerMessage
{
    /**
     * Instance attributes
     *
     * @var array
     */
    public $attributes = [
        'destination' => null,
        'content' => null,
        'sender' => null,

    ];

    /**
     * The onSuccess callback.
     *
     * @var
     */
    public $callback;

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
     * @param $destination
     * @return $this
     */
    public function to($destination)
    {
        $this->attributes['destination'] = $destination;
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
    public function callback(callable $callback)
    {
        $this->callback = $callback;
        return $this;
    }

    /**
     * The sender.
     *
     * @param null $sender
     * @return SprinklerMessage
     */
    public function sender($sender = null)
    {
        $this->attributes['sender'] = $sender;
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
            'destination' => $this->attributes['destination'],
            'content' => $this->attributes['content'],
            'sender' => $this->attributes['sender']
        ];
    }
}
