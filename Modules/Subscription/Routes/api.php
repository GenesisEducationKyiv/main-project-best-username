<?php

use Illuminate\Support\Facades\Route;
use Modules\Subscription\Http\Controllers\SubscriptionController;


Route::post('/subscribe', [SubscriptionController::class, 'subscribe'])->name('subscription.subscribe');
Route::post('/sendEmails', [SubscriptionController::class, 'sendEmails'])->name('subscription.sendEmails');
