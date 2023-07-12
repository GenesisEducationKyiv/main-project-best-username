<?php

use Illuminate\Support\Facades\Route;
use Modules\Rate\Http\Controllers\RateController;

Route::get('/rate', [RateController::class, 'index'])->name('rate.index');
