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
        $message = $notification->toSMS($notifiable)->to($to);
        $response = $this->sprinkler->send($message->toArray());

        return $response;
    }
}
