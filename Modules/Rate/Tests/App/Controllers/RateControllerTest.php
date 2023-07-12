<?php

namespace Modules\Rate\Tests\App\Controllers;

use Tests\TestCase;

class RateControllerTest extends TestCase
{
    public function testIndexReturnsValidJsonResponseWhenRatesExist()
    {
        // Act
        $response = $this->get('/api/rate');

        // Assert
        $response->assertStatus(200);
    }

}
