<?php

use App\Http\Controllers\Other\AuthController;
use App\Http\Controllers\Other\DashboardController;
use App\Http\Controllers\Other\MessageController;
use App\Http\Controllers\Other\MonthlyChargeController;
use App\Http\Controllers\Other\ProfileController;
use App\Http\Controllers\Other\TransactionController;
use Illuminate\Support\Facades\Route;


Route::middleware([])->prefix('auth')->group(function (){
    Route::get('/login', [AuthController::class, 'loginForm'])->name('other.auth.login-form');
    Route::post('/login', [AuthController::class, 'login'])->name('other.auth.login');
    Route::get('/logout', [AuthController::class, 'logout'])->name('other.auth.logout');
});
#
Route::middleware(['auth:other'])->prefix('dashboard')->group(function (){
    Route::get('/', [DashboardController::class, 'dashboard'])->name('other.dashboard.dashboard');
});

Route::middleware(['auth:other'])->prefix('monthly-charges')->group(function (){
    Route::get('/index', [MonthlyChargeController::class, 'index'])->name('other.monthly-charges.index');
});
#
Route::middleware(['auth:other'])->prefix('transactions')->group(function (){
    Route::any('/generate-url', [TransactionController::class, 'generateUrl'])->name('other.transaction.generate-url');
});
#
#
Route::middleware(['auth:other'])->prefix('transactions')->group(function (){
    Route::get('/', [TransactionController::class, 'index'])->name('other.transactions.index');
    Route::get('/export', [TransactionController::class, 'export'])->name('other.transactions.export');
    Route::get('/pdf/{id}', [TransactionController::class, 'pdf'])->name('other.transactions.pdf');
});
