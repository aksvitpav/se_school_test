<?php

namespace App\Http\Resources;

use App\Models\CurrencyRate;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CurrentRateResource extends JsonResource
{
    /** @var CurrencyRate */
    public $resource;

    /**
     * @var bool
     */
    public static $wrap = false;

    /**
     * @param Request $request
     * @return array
     */
    public function toArray(Request $request): array
    {
        return [
            'buy' => $this->resource->buy_rate,
            'sale' => $this->resource->sale_rate,
        ];
    }
}
