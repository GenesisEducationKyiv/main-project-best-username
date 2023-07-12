<?php

namespace Modules\Subscription\Tests\App\Controllers;

use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SubscriptionControllerTest extends TestCase
{
    use WithFaker;

    public function testSubscribeSuccessfully()
    {
        // act
        $response = $this->post('/api/subscribe', ['email' => $this->faker->email]);

        // assert
        $this->assertEquals(200, $response->getStatusCode());
    }
    public function testSendEmailsSuccessfully()
    {
        // act
        $response = $this->post('/api/sendEmails');

        // assert
        $this->assertEquals(200, $response->getStatusCode());
    }

}
