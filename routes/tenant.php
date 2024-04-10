<?php

use App\Http\Controllers\Tenant\AuthController;
use App\Http\Controllers\Tenant\DashboardController;
use Illuminate\Support\Facades\Route;


Route::middleware([])->prefix('auth')->group(function (){
    Route::get('/login', [AuthController::class, 'loginForm'])->name('tenant.auth.login-form');
    Route::post('/login', [AuthController::class, 'login'])->name('tenant.auth.login');
    Route::get('/logout', [AuthController::class, 'logout'])->name('tenant.auth.logout');
});
#
Route::middleware(['auth:tenant'])->prefix('dashboard')->group(function (){
    Route::get('/', [DashboardController::class, 'dashboard'])->name('tenant.dashboard.dashboard');
});
