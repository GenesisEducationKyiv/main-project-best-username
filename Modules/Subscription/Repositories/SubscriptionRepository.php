<?php

namespace Modules\Subscription\Repositories;

use Modules\Subscription\Entities\Subscription;
use Illuminate\Support\Facades\File;
use Modules\Subscription\Interfaces\SubscriptionRepositoryInterface;

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
