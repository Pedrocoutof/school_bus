<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\DriverController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/drivers', [DriverController::class, 'index'])->name('api.drivers.index');
Route::get('/drivers/{driver}', [DriverController::class, 'show'])->name('api.drivers.show');
Route::post('/drivers/store', [DriverController::class, 'store'])->name('api.drivers.store');
