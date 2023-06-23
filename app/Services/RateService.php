<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class RateService
{
    protected Client $httpClient;

    public function __construct()
    {
        $this->httpClient = new Client();
    }

    /**
     * @return mixed|null
     * @throws GuzzleException
     */
    public function getCurrentRates()
    {
        $response = $this->httpClient->get(
            'https://api.coingecko.com/api/v3/simple/price?ids=bitcoin&vs_currencies=UAH'
        );

        $data = json_decode($response->getBody(), true);

        if (isset($data['bitcoin']['uah'])) {
            return $data['bitcoin']['uah'];
        }

        return null;
    }

}
