<?php

namespace App\Http\Controllers\API;

use App\Services\NotificationService;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Services\SubscriptionService;
use App\Http\Requests\SubscribeRequest;

class SubscriptionController extends Controller
{
    private SubscriptionService $subscriptionService;
    private NotificationService $notificationService;

    public function __construct(?SubscriptionService $subscriptionService = null, ?NotificationService $notificationService = null)
    {
        $this->subscriptionService = $subscriptionService ?? new SubscriptionService();
        $this->notificationService = $notificationService ?? new NotificationService();
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


    /** Send email to all emails in database
     * @return JsonResponse
     */
    public function sendEmails(): JsonResponse
    {
        $this->notificationService->sendEmails();

        return response()->json();
    }
}
