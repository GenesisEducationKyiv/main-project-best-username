<?php

namespace Modules\Subscription\Services;

use Illuminate\Support\Facades\Mail;
use Modules\Rate\Services\RateService;

class NotificationService
{
    protected RateService $rateService;
    protected SubscriptionService $subscriptionService;

    public function __construct()
    {
        $this->rateService = new RateService();
        $this->subscriptionService = new SubscriptionService();
    }

    public function sendEmails(): bool
    {
        $emails = $this->subscriptionService->getEmails();

        // get actual BTC to UAH rate
        $currentRate = $this->rateService->getCurrentRates();

        // send email to all subscribed emails
        foreach ($emails as $email) {
            Mail::raw('Поточний курс BTC до UAH: ' . $currentRate, function ($message) use ($email) {
                $message->to($email)->subject('Актуальний курс BTC до UAH');
            });
        }

        return true;
    }

}
