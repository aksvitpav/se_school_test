<?php

namespace App\Adapters;

use App\Enums\CurrencyCodeEnum;
use App\Exceptions\CurrencyRateFetchingError;
use App\Interfaces\Adapters\CurrencyRateAdapterInterface;
use App\VOs\CurrencyRateVO;
use GuzzleHttp\Client;
use Throwable;
use UnexpectedValueException;

class PrivatBankCurrencyRateAdapter implements CurrencyRateAdapterInterface
{
    /**
     * @var string
     */
    protected string $baseUrl;

    /**
     * @var array<string, array<string, int|string>>
     */
    protected array $options;

    /**
     * @param Client $client
     */
    public function __construct(protected Client $client)
    {
        $baseUrl = config('currency_api.privat_bank_api_base_uri');
        if (!is_string($baseUrl)) {
            throw new UnexpectedValueException('The base URL must be a string.');
        }

        $this->baseUrl = $baseUrl;

        $this->options = [
            'query' => [
                'exchange' => 1,
                'coursid' => 5
            ],
        ];
    }

    /** @inheritDoc */
    public function getCurrencyRate(): CurrencyRateVO
    {
        try {
            $response = $this->client->request('GET', $this->baseUrl, $this->options);
            /** @var array<array{"ccy":string, "buy":float, "sale":float}> $data */
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
                !($USDBuyRate && $USDSaleRate && $EURBuyRate && $EURSaleRate),
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
