<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DeliveryController;

Route::prefix('admin')->group(function(){

    Route::get('/stats',
        [DashboardController::class,'stats']);

    Route::get('/deliveries',
        [DeliveryController::class,'index']);

    Route::post('/deliveries',
        [DeliveryController::class,'store']);

    Route::post('/deliveries/{id}/send-wa',
        [DeliveryController::class,'sendWa']);
});

Route::get('/', function () {
    return ['Laravel' => app()->version()];
});

require __DIR__.'/auth.php';