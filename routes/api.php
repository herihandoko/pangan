<?php
// routes/api.php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\TerasPangan\{
    SummaryController,
    SupplyBalanceController,
    PriceHistoryController,
    PriceStatisticsController,
    PricePerRegionController,
    PriceTrendsController,
    CheapFoodController,
    GkpController,
    MetadataController
};

Route::prefix('teras-pangan')->group(function () {
    Route::get('summary', [SummaryController::class, 'index']);
    Route::get('supply-balance', [SupplyBalanceController::class, 'index']);
    Route::get('price-history/daily', [PriceHistoryController::class, 'daily']);
    Route::get('price-statistics/quarterly', [PriceStatisticsController::class, 'quarterly']);
    Route::get('price-per-region', [PricePerRegionController::class, 'index']);
    Route::get('price-trends/monthly', [PriceTrendsController::class, 'monthly']);
    Route::get('cheap-food', [CheapFoodController::class, 'index']);
    Route::get('gkp', [GkpController::class, 'index']);
    Route::get('metadata', [MetadataController::class, 'index']);
});
