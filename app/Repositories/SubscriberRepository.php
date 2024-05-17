<?php

namespace App\Repositories;

use App\Interfaces\Repositories\SubscriberRepositoryInterface;
use App\Models\Subscriber;
use Illuminate\Database\Eloquent\Builder;

readonly class SubscriberRepository extends AbstractRepository implements SubscriberRepositoryInterface
{

    /** @inheritDoc */
    public function getModel(): Subscriber
    {
        return new Subscriber();
    }

    /** @inheritDoc */
    public function getQuery(): Builder
    {
        return Subscriber::query();
    }
}
