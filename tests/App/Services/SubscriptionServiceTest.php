<?php

namespace App\Services;

use Tests\TestCase;
use App\Services\SubscriptionService;
use Illuminate\Support\Facades\File;

class SubscriptionServiceTest extends TestCase
{

    private $databasePath;

    protected function setUp(): void
    {
        parent::setUp();

        $this->databasePath = 'test_database.json';

        // create empty database for tests
        File::put($this->databasePath, json_encode([]));
    }

    protected function tearDown(): void
    {
        parent::tearDown();

        // remove db file after each test
        File::delete($this->databasePath);
    }

    public function testSubscribeSuccessWhenAddsNewEmail()
    {
        $service = new SubscriptionService($this->databasePath);

        $result = $service->subscribe('yarosh.andrey2001@gmail.com');

        $this->assertTrue($result);

        $emails = $service->getEmails();
        $this->assertCount(1, $emails);
        $this->assertEquals('yarosh.andrey2001@gmail.com', $emails[0]);
    }

    public function testSubscribeReturnsFalseForExistingEmail()
    {
        $service = new SubscriptionService($this->databasePath);

        $service->subscribe('yarosh.andrey2001@gmail.com');

        $result = $service->subscribe('yarosh.andrey2001@gmail.com');

        $this->assertFalse($result);

        $emails = $service->getEmails();
        $this->assertCount(1, $emails);
        $this->assertEquals('yarosh.andrey2001@gmail.com', $emails[0]);
    }

    public function testSaveEmails()
    {
        $service = new SubscriptionService($this->databasePath);

        $emails = ['yarosh.andrii@icloud.com', 'yarosh.andrey2001@gmail.com'];

        $result = $service->saveEmails($emails);

        $this->assertTrue($result);
        $this->assertFileExists($this->databasePath);

        $content = File::get($this->databasePath);
        $decodedEmails = json_decode($content, true);
        $this->assertEquals($emails, $decodedEmails);
    }

}
