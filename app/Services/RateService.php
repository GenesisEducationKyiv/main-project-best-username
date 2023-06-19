<?php

namespace App\Services;

use GuzzleHttp\Client;

class RateService
{
    public function getCurrentRates()
    {
        $client = new Client();
        $response = $client->get('https://api.coingecko.com/api/v3/simple/price?ids=bitcoin&vs_currencies=UAH');

        $data = json_decode($response->getBody(), true);

        if (isset($data['bitcoin']['uah'])) {
            return $data['bitcoin']['uah'];
        }

        return null;
    }
}
