<?php

namespace Periloso\SprinklerNotifications;

use Exception;
use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\Exception\ClientException;
use Periloso\SprinklerNotifications\Exceptions\CouldNotRunCallback;
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
    public function send($params, callable $callback = null)
    {
        if (is_null($this->config['url'])) throw new Exception('Sprinkler gateway URL not set!');
        $url = $this->config['url'] . '/send';
        if (is_null($this->config['token'])) throw new Exception('Sprinkler gateway Token not set!');
        $token = $this->config['token'];

        try {
            $response = $this->client->post($url, [
                'json' => $params,
                'headers' => $this->getHeaders(),
            ]);
        } catch (ClientException $exception) {
            throw CouldNotSendNotification::remoteRespondedWithAnError($exception);
        } catch (Exception $exception) {
            throw CouldNotSendNotification::couldNotCommunicateWithRemote();
        }

        if ($callback) {
            try {
                $callback();
            } catch (Exception $exception) {
                throw CouldNotRunCallback::runtimeException($exception);
            }
        }
        return $response;
    }
}
