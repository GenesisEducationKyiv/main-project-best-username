<?php

namespace Modules\Rate\Http\Controllers;

use App\Http\Controllers\Controller;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\JsonResponse;
use Modules\Rate\Services\RateService;

class RateController extends Controller
{
    private RateService $rateService;

    public function __construct(RateService $rateService)
    {
        $this->rateService = $rateService;
    }

    /**
     * @return JsonResponse
     * @throws GuzzleException
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
