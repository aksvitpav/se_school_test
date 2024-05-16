<?php

namespace App\Actions;

use App\Enums\CurrencyCodeEnum;
use App\Interfaces\Repositories\CurrencyRateRepositoryInterface;
use App\Models\CurrencyRate;

class GetCurrentRateAction
{
    /**
     * @param CurrencyRateRepositoryInterface $currencyRateRepository
     */
    public function __construct(
        protected CurrencyRateRepositoryInterface $currencyRateRepository,
    ) {
    }

    /**
     * @return CurrencyRate|null
     */
    public function execute(): ?CurrencyRate
    {
        return $this->currencyRateRepository->findBy(
            [
                'currency_code' => CurrencyCodeEnum::USD->value
            ],
            'fetched_at',
            false
        );
    }
}
