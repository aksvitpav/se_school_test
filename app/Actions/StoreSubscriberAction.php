<?php

namespace App\Actions;

use App\DTOs\SubscriberDTO;
use App\Interfaces\Repositories\SubscriberRepositoryInterface;
use App\Models\Subscriber;

class StoreSubscriberAction
{
    /**
     * @param SubscriberRepositoryInterface $subscriberRepository
     */
    public function __construct(
        protected SubscriberRepositoryInterface $subscriberRepository,
    ) {
    }

    /**
     * @param SubscriberDTO $dto
     * @return Subscriber
     */
    public function execute(SubscriberDTO $dto): Subscriber
    {
        return $this->subscriberRepository->create($dto->toArray());
    }
}
