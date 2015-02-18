<?php namespace Destiny\Support\Traits;

use GuzzleHttp\Client;
use Destiny\Support\Exceptions\BungieUnavailableException;

trait MakesApiConnections {

    /**
     * Guzzle instance.
     *
     * @var \GuzzleHttp\Client
     */
    protected $http;

    /**
     * Initialize the trait.
     */
    protected function init()
    {
        $this->http = new Client(['base_url' => 'http://www.bungie.net']);
    }

    /**
     * Request a URL an throw an exception if there is no response, otherwise handle JSON.
     *
     * @param $url
     * @throws \Destiny\Support\Exceptions\BungieUnavailableException
     * @return array
     */
    protected function requestJson($url)
    {
        $response = $this->http->get($url);

        if ( ! $response) {
            throw new BungieUnavailableException;
        }

        return $response->json();
    }

} 