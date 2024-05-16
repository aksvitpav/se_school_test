<?php

namespace App\Http\Controllers;

use App\Actions\GetCurrentRateAction;
use App\Http\Resources\CurrentRateResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CurrentRateController extends Controller
{
    /**
     * @param Request $request
     * @param GetCurrentRateAction $getCurrentRateAction
     * @return CurrentRateResource|JsonResponse
     */
    public function __invoke(Request $request, GetCurrentRateAction $getCurrentRateAction): CurrentRateResource|JsonResponse
    {
        $currentRate = $getCurrentRateAction->execute();

        if ($currentRate) {
            return CurrentRateResource::make($currentRate);
        } else {
            return response()->json(['message' => 'Invalid status value'], Response::HTTP_BAD_REQUEST);
        }
    }
}
