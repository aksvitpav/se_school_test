<?php

namespace App\Interfaces\Adapters;

use App\VOs\CurrencyRateVO;

interface CurrencyRateAdapterInterface
{
    /**
     * @return CurrencyRateVO
     */
    public function getCurrencyRate(): CurrencyRateVO;
}
