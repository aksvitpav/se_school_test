<?php

namespace App\Http\Controllers;

use App\Actions\ExistSubscriberAction;
use App\Actions\StoreSubscriberAction;
use App\DTOs\SubscriberDTO;
use App\Http\Requests\SubscribeRequest;
use Symfony\Component\HttpFoundation\Response;

class SubscribeController extends Controller
{
    public function __invoke(
        SubscribeRequest $request,
        ExistSubscriberAction $existSubscriberAction,
        StoreSubscriberAction $storeSubscriberAction
    ) {
        $dto = SubscriberDTO::fromArray($request->validated());
        $isSubscruberExist = $existSubscriberAction->execute($dto);

        if (! $isSubscruberExist) {
            $storeSubscriberAction->execute($dto);
            return response()->json(['message' => 'Email successfully added'], Response::HTTP_OK);
        } else {
            return response()->json(['message' => 'Email already exists'], Response::HTTP_CONFLICT);
        }
    }
}
