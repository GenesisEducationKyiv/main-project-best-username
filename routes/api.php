<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\RateController;
use App\Http\Controllers\API\SubscriptionController;

Route::get('/rate', [RateController::class, 'index'])->name('rate.index');
Route::post('/subscribe', [SubscriptionController::class, 'subscribe'])->name('subscription.subscribe');
Route::post('/sendEmails', [SubscriptionController::class, 'sendEmails'])->name('subscription.sendEmails');
