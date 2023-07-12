<?php

namespace Modules\Subscription\Services;

use Modules\Subscription\Repositories\SubscriptionRepository;

class SubscriptionService
{
    private SubscriptionRepository $repository;

    public function __construct()
    {
        $this->repository = new SubscriptionRepository();
    }

    /**
     * @param string $email
     * @return bool
     */
    public function subscribe(string $email): bool
    {
        $emails = $this->repository->getEmails();
        if (in_array($email, $emails)) {
            return false;
        }

        $emails[] = $email;
        $this->repository->saveEmails($emails);

        return true;
    }

    public function getEmails(): array
    {
        return $this->repository->getEmails();
    }


}
