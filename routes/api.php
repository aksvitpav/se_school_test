<?php

use App\Http\Controllers\CurrentRateController;
use App\Http\Controllers\SubscribeController;
use Illuminate\Support\Facades\Route;

Route::get('/rate', CurrentRateController::class);
Route::post('/subscribe', SubscribeController::class);
