<?php

namespace App\Services;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;

class SubscriptionService
{
    private $databasePath = 'emails.json';

    /**
     * @param string $email
     * @return bool|null
     */
    public function subscribe(string $email)
    {
        $emails = $this->getEmails();
        if (in_array($email, $emails)) {
            return null;
        }

        $emails[] = $email;
        $this->saveEmails($emails);

        return true;
    }

    /**
     * @return JsonResponse
     */
    public function sendEmails()
    {
        $emails = $this->getEmails();

        // get actual BTC to UAH rate
        $currentRate = (new RateService())->getCurrentRates();

        // send email to all subscribed emails
        foreach ($emails as $email) {
            Mail::raw("Поточний курс BTC до UAH: $currentRate", function ($message) use ($email) {
                $message->to($email)->subject('Актуальний курс BTC до UAH');
            });
        }

        return response()->json();
    }

    /** Get list of emails from file storage
     * @return array|mixed
     */
    public function getEmails()
    {
        if (File::exists($this->databasePath)) {
            $content = File::get($this->databasePath);
            return json_decode($content, true);
        } else {
            return [];
        }
    }

    /** Put email to file storage
     * @param $emails
     * @return void
     */
    public function saveEmails($emails)
    {
        $content = json_encode($emails);
        File::put($this->databasePath, $content);
    }
}
