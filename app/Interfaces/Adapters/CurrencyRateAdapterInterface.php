<?php

namespace App\Interfaces\Adapters;

use App\VOs\CurrencyRateVO;

interface CurrencyRateAdapterInterface
{
    /**
     * @param string $url
     * @param array $options
     * @return CurrencyRateVO
     */
    public function getCurrencyRate(string $url, array $options): CurrencyRateVO;
}
