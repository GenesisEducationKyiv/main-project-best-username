<?php

namespace App\Services;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;

class SubscriptionService
{
    private string $databasePath = 'emails.json';

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
