<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Services\SubscriptionService;
use App\Http\Requests\SubscribeRequest;

class SubscriptionController extends Controller
{
    private SubscriptionService $subscriptionService;

    public function __construct()
    {
        $this->subscriptionService = new SubscriptionService();
    }

    /** Subscribe for email notification about current rate
     * @param SubscribeRequest $request
     * @return JsonResponse
     */
    public function subscribe(SubscribeRequest $request)
    {
        $email = $request->validated()['email'];
        $result = $this->subscriptionService->subscribe($email);

        if (!$result) {
            return response()->json('E-mail вже є в базі даних', 409);
        }

        return response()->json('E-mail додано');
    }


    /** Send email to all emails in database
     * @return JsonResponse
     */
    public function sendEmails()
    {
        $this->subscriptionService->sendEmails();

        return response()->json();
    }
}
