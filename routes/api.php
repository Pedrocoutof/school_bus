<?php

use App\Http\Controllers\Api\RouteController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\DriverController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/drivers', [DriverController::class, 'index'])->name('api.drivers.index');
Route::get('/drivers/{driver}', [DriverController::class, 'show'])->name('api.drivers.show');
Route::post('/drivers/store', [DriverController::class, 'store'])->name('api.drivers.store');
Route::delete('/drivers/{driver}', [DriverController::class, 'destroy'])->name('api.drivers.destroy');

Route::get('/routes', [RouteController::class, 'index'])->name('api.routes.index');
Route::post('/routes', [RouteController::class, 'store'])->name('api.routes.store');
Route::get('/routes/{id}', [RouteController::class, 'show'])->name('api.routes.show');
Route::delete('/routes/{route}', [RouteController::class, 'destroy'])->name('api.routes.destroy');
