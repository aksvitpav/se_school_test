<?php

namespace App\Adapters;

use App\Enums\CurrencyCodeEnum;
use App\Exceptions\CurrencyRateFetchingError;
use App\Interfaces\Adapters\CurrencyRateAdapterInterface;
use App\VOs\CurrencyRateVO;
use GuzzleHttp\Client;
use Throwable;

class PrivatBankCurrencyRateAdapter implements CurrencyRateAdapterInterface
{
    /**
     * @var string
     */
    protected string $baseUrl;

    /**
     * @param Client $client
     */
    public function __construct(protected Client $client)
    {
        $this->baseUrl = config('currency_api.privat_bank_api_base_uri');
    }

    /** @inheritDoc */
    public function getCurrencyRate(string $url, array $options): CurrencyRateVO
    {
        try {
            $response = $this->client->request('GET', $this->baseUrl . $url, $options);
            $data = json_decode($response->getBody()->getContents(), true);

            $USDBuyRate = null;
            $USDSaleRate = null;
            $EURBuyRate = null;
            $EURSaleRate = null;

            foreach ($data as $currency) {
                if ($currency['ccy'] === CurrencyCodeEnum::USD->value) {
                    $USDBuyRate = $currency['buy'];
                    $USDSaleRate = $currency['sale'];
                }

                if ($currency['ccy'] === CurrencyCodeEnum::EUR->value) {
                    $EURBuyRate = $currency['buy'];
                    $EURSaleRate = $currency['sale'];
                }
            }

            throw_if(
                ! ($USDBuyRate && $USDSaleRate && $EURBuyRate && $EURSaleRate),
                new CurrencyRateFetchingError('Currency rates not found in response.')
            );

            return new CurrencyRateVO(
                USDBuyRate: $USDBuyRate,
                USDSaleRate: $USDSaleRate,
                EURBuyRate: $EURBuyRate,
                EURSaleRate: $EURSaleRate,
            );
        } catch (Throwable $e) {
            return new CurrencyRateVO(error: $e->getMessage());
        }
    }
}
