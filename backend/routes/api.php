<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\DeliveryController;

Route::get('/deliveries', [DeliveryController::class, 'index']);
Route::post('/deliveries', [DeliveryController::class, 'store']);
Route::put('/deliveries/{id}', [DeliveryController::class, 'update']);
Route::delete('/deliveries/{id}', [DeliveryController::class, 'destroy']);

Route::get('/delivery/{token}', [DeliveryController::class, 'showByToken']);
Route::post('/delivery/confirm/{token}', [DeliveryController::class, 'confirm']);

Route::get('/admin/generate-wa-link/{id}', [DeliveryController::class, 'generateWaLink']);