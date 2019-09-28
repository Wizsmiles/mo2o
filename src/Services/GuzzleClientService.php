<?php


namespace App\Services;

use GuzzleHttp\Client;

class GuzzleClientService
{

    public function request($method, $uri, $options)
    {
        $client = new Client();
        $response = $client->request($method, $uri, $options);
        return $response->getBody()->getContents();
    }

}