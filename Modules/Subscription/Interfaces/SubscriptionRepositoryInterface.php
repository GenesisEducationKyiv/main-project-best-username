<?php

namespace Modules\Subscription\Interfaces;

interface SubscriptionRepositoryInterface
{
    public function getEmails(): array;

    public function saveEmails(array $emails): void;

}
