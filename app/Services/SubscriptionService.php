<?php

namespace App\Services;

use Illuminate\Support\Facades\File;

class SubscriptionService
{
    private string $databasePath;

    public function __construct(string $databasePath = 'emails.json')
    {
        $this->databasePath = $databasePath;
    }

    /**
     * @param string $email
     * @return bool
     */
    public function subscribe(string $email): bool
    {
        $emails = $this->getEmails();
        if (in_array($email, $emails)) {
            return false;
        }

        $emails[] = $email;
        $this->saveEmails($emails);

        return true;
    }

    /** Get list of emails from file storage
     * @return array
     */
    public function getEmails(): array
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
     * @return bool
     */
    public function saveEmails($emails): bool
    {
        $content = json_encode($emails);
        File::put($this->databasePath, $content);

        return true;
    }

}
