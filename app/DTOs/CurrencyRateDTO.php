<?php

namespace App\DTOs;

use Illuminate\Support\Carbon;

readonly class CurrencyRateDTO
{
    /**
     * @param string $currencyCode
     * @param float $buyRate
     * @param float $saleRate
     * @param Carbon $fetchedAt
     * @param int|null $id
     */
    public function __construct(
        private string $currencyCode,
        private float $buyRate,
        private float $saleRate,
        private Carbon $fetchedAt,
        private ?int $id = null,
    ) {
    }

    /**
     * @param array $data
     * @return CurrencyRateDTO
     */
    public static function fromArray(array $data): CurrencyRateDto
    {
        return new CurrencyRateDTO(
            currencyCode: $data['currency_code'],
            buyRate: $data['buy_rate'],
            saleRate: $data['sale_rate'],
            fetchedAt: now(),
            id: $data['id'] ?? null,
        );
    }

    /**
     * @return string
     */
    public function getCurrencyCode(): string
    {
        return $this->currencyCode;
    }

    /**
     * @return float
     */
    public function getBuyRate(): float
    {
        return $this->buyRate;
    }

    /**
     * @return float
     */
    public function getSaleRate(): float
    {
        return $this->saleRate;
    }

    /**
     * @return Carbon
     */
    public function getFetchedAt(): Carbon
    {
        return $this->fetchedAt;
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'currency_code' => $this->currencyCode,
            'buy_rate' => $this->buyRate,
            'sale_rate' => $this->saleRate,
            'fetched_at' => $this->fetchedAt,
        ];
    }
}
