<?php

namespace App\VOs;

class CurrencyRateVO
{
    /**
     * @param float|null $USDBuyRate
     * @param float|null $USDSaleRate
     * @param float|null $EURBuyRate
     * @param float|null $EURSaleRate
     * @param string|null $error
     */
    public function __construct(
        protected ?float $USDBuyRate = null,
        protected ?float $USDSaleRate = null,
        protected ?float $EURBuyRate = null,
        protected ?float $EURSaleRate = null,
        protected ?string $error = null
    ) {
    }

    /**
     * @return float|null
     */
    public function getUSDBuyRate(): ?float
    {
        return $this->USDBuyRate;
    }

    /**
     * @return float|null
     */
    public function getUSDSaleRate(): ?float
    {
        return $this->USDSaleRate;
    }

    /**
     * @return float|null
     */
    public function getEURBuyRate(): ?float
    {
        return $this->USDBuyRate;
    }

    /**
     * @return float|null
     */
    public function getEURSaleRate(): ?float
    {
        return $this->USDSaleRate;
    }

    /**
     * @return string|null
     */
    public function getError(): ?string
    {
        return $this->error;
    }

    /**
     * @return bool
     */
    public function hasError(): bool
    {
        return (bool)$this->error;
    }
}
