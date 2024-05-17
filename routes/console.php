<?php

use App\Console\Commands\ClearCurrencyRateCommand;
use App\Console\Commands\FetchCurrencyRateCommand;
use App\Console\Commands\SendDailyEmailsCommand;
use Illuminate\Support\Facades\Schedule;

Schedule::command(ClearCurrencyRateCommand::class)->daily();
Schedule::command(SendDailyEmailsCommand::class)->hourly();
Schedule::command(FetchCurrencyRateCommand::class)->everyFifteenMinutes();
