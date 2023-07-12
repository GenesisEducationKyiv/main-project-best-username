<?php

namespace Modules\Subscription\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use Modules\Rate\Http\Requests\SubscribeRequest;
use Modules\Subscription\Services\NotificationService;
use Modules\Subscription\Services\SubscriptionService;

class SubscriptionController extends Controller
{
    private SubscriptionService $subscriptionService;
    private NotificationService $notificationService;

    public function __construct(SubscriptionService $subscriptionService, NotificationService $notificationService)
    {
        $this->subscriptionService = $subscriptionService;
        $this->notificationService = $notificationService;
    }

    /** Subscribe for email notification about current rate
     * @param SubscribeRequest $request
     * @return JsonResponse
     */
    public function subscribe(SubscribeRequest $request): JsonResponse
    {
        $email = $request->validated()['email'];
        $subscriptionResult = $this->subscriptionService->subscribe($email);

        if (!$subscriptionResult) {
            return response()->json('E-mail вже є в базі даних', 409);
        }

        return response()->json('E-mail додано');
    }


    //TODO: move to NotificationController


    /** Send email to all emails in database
     * @return JsonResponse
     */
    public function sendEmails(): JsonResponse
    {
        $this->notificationService->sendEmails();

        return response()->json();
    }
}

