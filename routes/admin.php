<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\FiscalYearController;
use App\Http\Controllers\Admin\FloorController;
use App\Http\Controllers\Admin\MessageGroupController;
use App\Http\Controllers\Admin\TenantController;
use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\Admin\WarningController;
use Illuminate\Support\Facades\Route;


Route::middleware([])->prefix('auth')->group(function (){
    Route::get('/login', [AuthController::class, 'loginForm'])->name('admin.auth.login-form');
    Route::post('/login', [AuthController::class, 'login'])->name('admin.auth.login');
    Route::get('/logout', [AuthController::class, 'logout'])->name('admin.auth.logout');
});
#
Route::middleware(['auth:admin'])->prefix('dashboard')->group(function (){
    Route::get('/', [DashboardController::class, 'dashboard'])->name('admin.dashboard.dashboard');
});
#
Route::middleware(['auth:admin'])->prefix('tenants')->group(function (){
    Route::get('/', [TenantController::class, 'index'])->name('admin.tenants.index');
    Route::get('/create', [TenantController::class, 'create'])->name('admin.tenants.create');
    Route::post('/store', [TenantController::class, 'store'])->name('admin.tenants.store');
    Route::get('/edit/{id}', [TenantController::class, 'edit'])->name('admin.tenants.edit');
    Route::post('/update/{id}', [TenantController::class, 'update'])->name('admin.tenants.update');
    Route::get('/monthly-charges/{id}', [TenantController::class, 'monthlyCharges'])->name('admin.tenants.monthly-charges');
    Route::get('/monthly-charges/{id}/fake-pay', [TenantController::class, 'fakePayMonthlyCharge'])->name('admin.tenants.fake-pay.monthly-charges');
    Route::get('/set-default-password/{id}', [TenantController::class, 'setDefaultPassword'])->name('admin.tenants.set-default-password');
});
#
Route::middleware(['auth:admin'])->prefix('complex-settings')->group(function (){
    Route::middleware([])->prefix('floors')->group(function (){
        Route::get('/', [FloorController::class, 'index'])->name('admin.complex-settings.floors.index');
        Route::get('/edit/{id}', [FloorController::class, 'edit'])->name('admin.complex-settings.floors.edit');
        Route::post('/update/{id}', [FloorController::class, 'update'])->name('admin.complex-settings.floors.update');
    });
    Route::middleware([])->prefix('message-groups')->group(function (){
        Route::get('/', [MessageGroupController::class, 'index'])->name('admin.complex-settings.message-groups.index');
        Route::get('/create', [MessageGroupController::class, 'create'])->name('admin.complex-settings.message-groups.create');
        Route::post('/store', [MessageGroupController::class, 'store'])->name('admin.complex-settings.message-groups.store');
        Route::get('/edit/{id}', [MessageGroupController::class, 'edit'])->name('admin.complex-settings.message-groups.edit');
        Route::post('/update/{id}', [MessageGroupController::class, 'update'])->name('admin.complex-settings.message-groups.update');
        Route::get('/destroy/{id}', [MessageGroupController::class, 'destroy'])->name('admin.complex-settings.message-groups.destroy');
    });
});
#
Route::middleware(['auth:admin'])->prefix('fiscal-years')->group(function (){
    Route::get('/', [FiscalYearController::class, 'index'])->name('admin.fiscal-years.index');
    Route::get('/create', [FiscalYearController::class, 'create'])->name('admin.fiscal-years.create');
    Route::post('/store', [FiscalYearController::class, 'store'])->name('admin.fiscal-years.store');
    Route::get('/edit/{id}', [FiscalYearController::class, 'edit'])->name('admin.fiscal-years.edit');
    Route::post('/update/{id}', [FiscalYearController::class, 'update'])->name('admin.fiscal-years.update');
    Route::get('/destroy/{id}', [FiscalYearController::class, 'destroy'])->name('admin.fiscal-years.destroy');
});
#
Route::middleware(['auth:admin'])->prefix('coupons')->group(function (){
    Route::get('/', [CouponController::class, 'index'])->name('admin.coupons.index');
    Route::get('/edit/{id}', [CouponController::class, 'edit'])->name('admin.coupons.edit');
    Route::post('/update/{id}', [CouponController::class, 'update'])->name('admin.coupons.update');
});
#
Route::middleware(['auth:admin'])->prefix('transactions')->group(function (){
    Route::get('/', [TransactionController::class, 'index'])->name('admin.transactions.index');
    Route::get('/export', [TransactionController::class, 'export'])->name('admin.transactions.export');
    Route::get('/pdf/{id}', [TransactionController::class, 'pdf'])->name('admin.transactions.pdf');
});
#
Route::middleware(['auth:admin'])->prefix('warnings')->group(function (){
    Route::get('/', [WarningController::class, 'index'])->name('admin.warnings.index');
    Route::get('/destroy/{id}', [WarningController::class, 'destroy'])->name('admin.warnings.destroy');
});
