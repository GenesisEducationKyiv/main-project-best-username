<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use Tests\TestCase;

class RateServiceTest extends TestCase
{

    public function testGetCurrentRates()
    {
        $httpClient = $this->createMock(Client::class);

        $response = new Response(200, [], '{"bitcoin": {"uah": 123}}');

        $httpClient->method('get')->willReturn($response);

        $rateService = new RateService($httpClient);

        $rate = $rateService->getCurrentRates();
        $this->assertSame(123, $rate);
    }

}
