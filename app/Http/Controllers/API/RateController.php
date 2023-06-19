<?php

namespace App\Http\Controllers\API;

use App\Services\RateService;
use App\Http\Controllers\Controller;

class RateController extends Controller
{
    public function index()
    {
        $result = (new RateService())->getCurrentRates();

        if (!$result) {
            return response()->json(0, 400);
        }

        return response()->json($result);
    }
}
