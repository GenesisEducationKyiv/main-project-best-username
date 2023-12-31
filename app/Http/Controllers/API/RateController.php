<?php

namespace App\Http\Controllers\API;

use App\Services\RateService;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class RateController extends Controller
{
    private RateService $rateService;

    public function __construct(RateService $rateService)
    {
        $this->rateService = $rateService;
    }

    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $currentRates = $this->rateService->getCurrentRates();

        if (!$currentRates) {
            return response()->json(0, 400);
        }

        return response()->json($currentRates);
    }
}
