<?php

namespace App\Repositories;

use App\Interfaces\SubscriptionRepositoryInterface;
use Illuminate\Support\Facades\File;
use App\Models\Subscription;
class SubscriptionRepository implements SubscriptionRepositoryInterface
{

    public function getEmails(): array
    {
        if (File::exists(Subscription::databasePath)) {
            $content = File::get(Subscription::databasePath);
            return json_decode($content, true);
        } else {
            return [];
        }
    }

    public function saveEmails(array $emails): void
    {
        $content = json_encode($emails);
        File::put(Subscription::databasePath, $content);
    }

}
