<?php

namespace Periloso\SprinklerNotifications;

use Exception;
use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\Exception\ClientException;
use Periloso\SprinklerNotifications\Exceptions\CouldNotSendNotification;

class Sprinkler
{
    protected $config = [];
    protected $client;

    /**
     * Sprinkler constructor.
     *
     * @param $config
     * @param $client
     */
    public function __construct($config, HttpClient $client)
    {
        $this->config = $config;
        $this->client = $client;
        return $this;
    }

    /**
     * Retrieves the headers for API calls.
     *
     * @return array
     */
    protected function getHeaders()
    {
        return [
            'Access-Token' => $this->config['token'],
        ];
    }

    /**
     * Send request to the remote server API.
     *
     * @param $params
     * @return \Psr\Http\Message\ResponseInterface
     * @throws Exception
     */
    public function send($params)
    {
        if (is_null($this->config['url'])) throw new Exception('Sprinkler gateway URL not set!');
        $url = $this->config['url'];
        if (is_null($this->config['token'])) throw new Exception('Sprinkler gateway TOKEN not set!');
        $token = $this->config['token'];

        try {
            return $this->client->post($url, [
                'json' => $params,
                'headers' => $this->getHeaders(),
            ]);
        } catch (ClientException $exception) {
            throw CouldNotSendNotification::remoteRespondedWithAnError($exception);
        } catch (Exception $exception) {
            throw CouldNotSendNotification::couldNotCommunicateWithRemote();
        }
    }
}
