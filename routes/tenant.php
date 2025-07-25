<?php

use App\Http\Controllers\Tenant\AuthController;
use App\Http\Controllers\Tenant\BedehiOmraniController;
use App\Http\Controllers\Tenant\DashboardController;
use App\Http\Controllers\Tenant\MessageController;
use App\Http\Controllers\Tenant\MonthlyChargeController;
use App\Http\Controllers\Tenant\ProfileController;
use App\Http\Controllers\Tenant\TransactionController;
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
#
Route::middleware(['auth:tenant'])->prefix('profile')->group(function (){
    Route::get('/edit', [ProfileController::class, 'edit'])->name('tenant.profile.edit');
    Route::post('/update', [ProfileController::class, 'update'])->name('tenant.profile.update');
    Route::post('/update-phone-number', [ProfileController::class, 'updatePhoneNumber'])->name('tenant.profile.update-phone-number');
});
#
Route::middleware(['auth:tenant'])->prefix('messages')->group(function (){
    Route::get('/index', [MessageController::class, 'index'])->name('tenant.messages.index');
    Route::get('/seen/{id}', [MessageController::class, 'seen'])->name('tenant.messages.seen');
});
#
Route::middleware(['auth:tenant'])->prefix('monthly-charges')->group(function (){
    Route::get('/index', [MonthlyChargeController::class, 'index'])->name('tenant.monthly-charges.index');
});
Route::middleware(['auth:tenant'])->prefix('bedehi-omranis')->group(function (){
    Route::get('/index', [BedehiOmraniController::class, 'index'])->name('tenant.bedehi-omranis.index');
});
#
Route::middleware(['auth:tenant'])->prefix('transactions')->group(function (){
    Route::any('/choose-gateway', [TransactionController::class, 'chooseGateway'])->name('tenant.transaction.choose-gateway');
    Route::any('/generate-url', [TransactionController::class, 'generateUrl'])->name('tenant.transaction.generate-url');
});
#
#
Route::middleware(['auth:tenant'])->prefix('transactions')->group(function (){
    Route::get('/', [TransactionController::class, 'index'])->name('tenant.transactions.index');
    Route::get('/export', [TransactionController::class, 'export'])->name('tenant.transactions.export');
    Route::get('/pdf/{id}', [TransactionController::class, 'pdf'])->name('tenant.transactions.pdf');
});
