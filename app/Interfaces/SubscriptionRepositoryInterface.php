<?php

namespace App\Interfaces;

interface SubscriptionRepositoryInterface
{
    public function getEmails(): array;

    public function saveEmails(array $orderDetails): void;

}
