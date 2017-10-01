<?php

namespace Periloso\SprinklerNotifications;

use Illuminate\Notifications\Notification;

class SprinklerChannel
{
    protected $sprinkler;

    /**
     * SprinklerChannel constructor.
     *
     * @param Sprinkler $sprinkler
     */
    public function __construct(Sprinkler $sprinkler)
    {
        $this->sprinkler = $sprinkler;
    }

    /**
     * Send the given notification.
     *
     * @param $notifiable
     * @param Notification $notification
     * @return \Psr\Http\Message\ResponseInterface|void
     */

    public function send($notifiable, Notification $notification)
    {
        if (! $to = $notifiable->routeNotificationFor('Sprinkler')) {
            return;
        }
        $message = $notification->toSprinkler($notifiable)->to($to)->toArray();
        $callback = $message['callback'];
        $message = array_except($message, "callback");
        $response = $this->sprinkler->send($message, $callback);

        return $response;
    }
}
