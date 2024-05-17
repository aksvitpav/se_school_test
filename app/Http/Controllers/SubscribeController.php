<?php

namespace App\Http\Controllers;

use App\Actions\ExistSubscriberAction;
use App\Actions\StoreSubscriberAction;
use App\DTOs\SubscriberDTO;
use App\Http\Requests\SubscribeRequest;
use Illuminate\Http\JsonResponse;
use OpenApi\Annotations as OA;
use Symfony\Component\HttpFoundation\Response;

class SubscribeController extends Controller
{
    /**
     * @OA\Post(
     *       path="/api/subscribe",
     *       operationId="subscribe-the-email",
     *       summary="Subscribe the email",
     *       tags={"Subscription"},
     *       description="Subscribe the email",
     *       @OA\RequestBody(
     *           required=true,
     *           @OA\JsonContent(ref="#/components/schemas/SubscribeRequest")
     *       ),
     *       @OA\Response(
     *         response="200",
     *         description="Successful",
     *         @OA\JsonContent(
     *                 @OA\Property(
     *                     property="message",
     *                     type="string",
     *                     example="Email successfully added"
     *                 )
     *             )
     *       ),
     *      @OA\Response(
     *            response=409,
     *            description="Conflict",
     *            @OA\JsonContent(
     *                @OA\Property(
     *                    property="message",
     *                    type="string",
     *                    example="Email already exists"
     *                )
     *            )
     *        )
     *   )
     *
     * @param SubscribeRequest $request
     * @param ExistSubscriberAction $existSubscriberAction
     * @param StoreSubscriberAction $storeSubscriberAction
     * @return JsonResponse
     */
    public function __invoke(
        SubscribeRequest $request,
        ExistSubscriberAction $existSubscriberAction,
        StoreSubscriberAction $storeSubscriberAction
    ): JsonResponse {
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
