<?php

use App\Http\Controllers\DriverController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RouteController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use \App\Http\Middleware\CheckMultipleGuards;
use Inertia\Inertia;

Route::get('/', function () {
    return redirect(route('dashboard'));
});

Route::middleware(CheckMultipleGuards::class)->group(function () {

    Route::get('/dashboard', function () { return Inertia::render('Dashboard'); })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/drivers', [DriverController::class, 'index'])->name('drivers.index');
    Route::get('/routes', [RouteController::class, 'index'])->name('routes.index');
});

Route::get('/vue', function () {
    return Inertia::render('Welcome', []);
});

require __DIR__.'/auth.php';
