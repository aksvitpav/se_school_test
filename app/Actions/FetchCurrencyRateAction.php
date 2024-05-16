<?php

namespace App\Actions;

use App\Interfaces\Adapters\CurrencyRateAdapterInterface;
use App\Interfaces\Repositories\CurrencyRateRepositoryInterface;
use App\VOs\CurrencyRateVO;

class FetchCurrencyRateAction
{
    /**
     * @param CurrencyRateAdapterInterface $apiAdapter
     * @param CurrencyRateRepositoryInterface $currencyRateRepository
     */
    public function __construct(
        protected CurrencyRateAdapterInterface $apiAdapter,
        protected CurrencyRateRepositoryInterface $currencyRateRepository,
    ) {
    }

    /**
     * @return CurrencyRateVO
     */
    public function execute(): CurrencyRateVO
    {
        $options = [
            'query' => [
                'exchange' => 1,
                'coursid' => 5
            ],
        ];

        return $this->apiAdapter->getCurrencyRate('', $options);
    }
}
