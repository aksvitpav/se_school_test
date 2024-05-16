<?php

namespace App\Models;

use App\Casts\CurrencyCast;
use App\Enums\CurrencyCodeEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CurrencyRate extends Model
{
    use HasFactory;

    protected $fillable = [
        'currency_code',
        'buy_rate',
        'sale_rate',
        'fetched_at',
    ];

    protected function casts(): array
    {
        return [
            'currency_code' => CurrencyCodeEnum::class,
            'buy_rate' => CurrencyCast::class,
            'sale_rate' => CurrencyCast::class,
            'fetching_date' => 'datetime',
        ];
    }
}
