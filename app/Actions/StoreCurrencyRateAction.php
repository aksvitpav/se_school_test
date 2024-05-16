<?php

namespace App\Actions;

use App\DTOs\CurrencyRateDTO;
use App\Interfaces\Repositories\CurrencyRateRepositoryInterface;
use App\Models\CurrencyRate;

class StoreCurrencyRateAction
{
    /**
     * @param CurrencyRateRepositoryInterface $currencyRateRepository
     */
    public function __construct(
        protected CurrencyRateRepositoryInterface $currencyRateRepository,
    ) {
    }

    /**
     * @param CurrencyRateDTO $dto
     * @return CurrencyRate
     */
    public function execute(CurrencyRateDTO $dto): CurrencyRate
    {
        /** @var CurrencyRate $lastRate */
        $lastRate = $this->currencyRateRepository->findBy(
            [
                'currency_code' => $dto->getCurrencyCode()
            ],
            'fetched_at',
            false
        );

        if (
            $lastRate?->buy_rate === $dto->getBuyRate()
            && $lastRate?->sale_rate === $dto->getSaleRate()
        ) {
            return $this->currencyRateRepository->updateById(
                $lastRate->id,
                [
                    'fetched_at' => $dto->getFetchedAt()
                ]
            );
        }

        if ($lastRate?->fetched_at < now()/*->subHour()*/) {
            return $this->currencyRateRepository->create($dto->toArray());
        }

        return $lastRate;
    }
}
