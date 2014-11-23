<?php namespace Destiny;

use Destiny\Game\Player;
use Exception;
use GuzzleHttp\Client as Http;

class Client {

    /**
     * @var \GuzzleHttp\Client
     */
    private $http;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->http = new Http();
    }

    /**
     * Fetch a player/user by username and platform.
     *
     * @param $username
     * @param $platform
     * @return \Destiny\User
     * @throws \Exception
     */
    public function fetchPlayer($username, $platform)
    {
        $response = $this->http->get('http://www.bungie.net/Platform/Destiny/SearchDestinyPlayer/' . $platform . '/' . $username);

        $json = $response->json();

        if( ! isset($json['Response'][0]['membershipId']))
        {
            throw new Exception('Player not found');
        }

        return new Player(
            $json['Response'][0]['iconPath'],
            $json['Response'][0]['membershipType'],
            $json['Response'][0]['membershipId'],
            $json['Response'][0]['displayName']
        );
    }

} 