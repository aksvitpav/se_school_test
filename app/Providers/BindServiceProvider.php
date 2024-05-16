<?php

namespace App\Providers;

use App\Adapters\PrivatBankCurrencyRateAdapter;
use App\Interfaces\Adapters\CurrencyRateAdapterInterface;
use App\Interfaces\Repositories\CurrencyRateRepositoryInterface;
use App\Repositories\CurrencyRateRepository;
use Illuminate\Support\ServiceProvider;

class BindServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->registerAdapters();
        $this->registerRepositories();
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }

    /**
     * @return void
     */
    private function registerAdapters(): void
    {
        $this->app->bind(CurrencyRateAdapterInterface::class, PrivatBankCurrencyRateAdapter::class);
    }

    /**
     * @return void
     */
    private function registerRepositories(): void
    {
        $this->app->bind(CurrencyRateRepositoryInterface::class, CurrencyRateRepository::class);
    }
}
