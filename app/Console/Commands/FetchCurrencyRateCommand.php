<?php

namespace App\Console\Commands;

use App\Actions\FetchCurrencyRateAction;
use App\Actions\StoreCurrencyRateAction;
use App\DTOs\CurrencyRateDTO;
use App\Enums\CurrencyCodeEnum;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class FetchCurrencyRateCommand extends Command
{
    /**
     * @var string
     */
    protected $signature = 'app:fetch-currency-rate';

    /**
     * @var string
     */
    protected $description = 'Fetch currency rates from API';

    /**
     * @param FetchCurrencyRateAction $fetchCurrencyRate
     * @param StoreCurrencyRateAction $storeCurrencyRateAction
     * @return void
     */
    public function handle(
        FetchCurrencyRateAction $fetchCurrencyRate,
        StoreCurrencyRateAction $storeCurrencyRateAction
    ): void {
        $vo = $fetchCurrencyRate->execute();
        if (! $vo->hasError()) {
            $usdDto = CurrencyRateDTO::fromArray([
                'currency_code' => CurrencyCodeEnum::USD->value,
                'buy_rate' => $vo->getUSDBuyRate(),
                'sale_rate' => $vo->getUSDSaleRate(),
            ]);

            $storeCurrencyRateAction->execute($usdDto);
        } else {
            Log::error('Can\'t fetch currency rate', ['error' => $vo->getError()]);
        }
    }
}
