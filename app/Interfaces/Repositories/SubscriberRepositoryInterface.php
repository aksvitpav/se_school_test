<?php

namespace App\Interfaces\Repositories;

use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;

interface SubscriberRepositoryInterface extends RepositoryInterface
{
    /**
     * @param Carbon $toDate
     * @return Collection
     */
    public function getNotEmailedSubscribers(Carbon $toDate): Collection;
}
