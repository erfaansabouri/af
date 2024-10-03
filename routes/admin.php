<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ExportController;
use App\Http\Controllers\Admin\FiscalYearController;
use App\Http\Controllers\Admin\FloorController;
use App\Http\Controllers\Admin\MessageGroupController;
use App\Http\Controllers\Admin\OtherController;
use App\Http\Controllers\Admin\SettingController;
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
    Route::get('/export-did-not-pay-monthly-charge', [TenantController::class, 'exportDidNotPayMonthlyCharge'])->name('admin.tenants.export-did-not-pay-monthly-charge');
    Route::get('/create', [TenantController::class, 'create'])->name('admin.tenants.create');
    Route::post('/store', [TenantController::class, 'store'])->name('admin.tenants.store');
    Route::get('/edit/{id}', [TenantController::class, 'edit'])->name('admin.tenants.edit');
    Route::post('/update/{id}', [TenantController::class, 'update'])->name('admin.tenants.update');
    Route::get('/monthly-charges/{id}', [TenantController::class, 'monthlyCharges'])->name('admin.tenants.monthly-charges');
    Route::any('/fake-transaction', [TenantController::class, 'fakeTransaction'])->name('admin.tenants.fake-transaction');
    Route::get('/set-default-password/{id}', [TenantController::class, 'setDefaultPassword'])->name('admin.tenants.set-default-password');
    Route::any('/submit-bestankari', [TenantController::class, 'submitBestankari'])->name('admin.tenants.submit-bestankari');
    Route::any('/submit-bedehkari', [TenantController::class, 'submitBedehkari'])->name('admin.tenants.submit-bedehkari');
    Route::any('/remove-bedehkari/{id}', [TenantController::class, 'removeBedehkari'])->name('admin.tenants.remove-bedehkari');
    Route::any('/restore-monthly-charge/{id}', [TenantController::class, 'restoreMonthlyCharge'])->name('admin.tenants.restore-monthly-charge');

    Route::any('/submit-ownership-debt', [TenantController::class, 'submitOwnershipDebt'])->name('admin.tenants.submit-ownership-debt');
    Route::any('/remove-ownership-debt/{id}', [TenantController::class, 'removeOwnershipDebt'])->name('admin.tenants.remove-ownership-debt');


});
#

Route::middleware(['auth:admin'])->prefix('others')->group(function (){
    Route::get('/', [OtherController::class, 'index'])->name('admin.others.index');
    Route::get('/create', [OtherController::class, 'create'])->name('admin.others.create');
    Route::post('/store', [OtherController::class, 'store'])->name('admin.others.store');
    Route::get('/edit/{id}', [OtherController::class, 'edit'])->name('admin.others.edit');
    Route::post('/update/{id}', [OtherController::class, 'update'])->name('admin.others.update');
    Route::get('/set-default-password/{id}', [OtherController::class, 'setDefaultPassword'])->name('admin.others.set-default-password');

    Route::get('/financial-period/{id}', [OtherController::class, 'financialPeriod'])->name('admin.others.financial-period');
    Route::post('/create-financial-period/{id}', [OtherController::class, 'createFinancialPeriod'])->name('admin.others.create-financial-period');
    Route::get('/delete-financial-period-log/{id}', [OtherController::class, 'deleteFinancialPeriodLog'])->name('admin.others.delete-financial-period-log');

    Route::any('/submit-bestankari', [OtherController::class, 'submitBestankari'])->name('admin.others.submit-bestankari');
    Route::any('/restore-monthly-charge/{id}', [OtherController::class, 'restoreMonthlyCharge'])->name('admin.others.restore-monthly-charge');
    Route::any('/remove-monthly-charge/{id}', [OtherController::class, 'removeMonthlyCharge'])->name('admin.others.remove-monthly-charge');
    Route::any('/submit-bedehkari', [OtherController::class, 'submitBedehkari'])->name('admin.others.submit-bedehkari');
    Route::any('/remove-bedehkari/{id}', [OtherController::class, 'removeBedehkari'])->name('admin.others.remove-bedehkari');

});
#
Route::middleware(['auth:admin'])->prefix('complex-settings')->group(function (){
    Route::middleware([])->prefix('floors')->group(function (){
        Route::get('/', [FloorController::class, 'index'])->name('admin.complex-settings.floors.index');
        Route::get('/edit/{id}', [FloorController::class, 'edit'])->name('admin.complex-settings.floors.edit');
        Route::post('/update/{id}', [FloorController::class, 'update'])->name('admin.complex-settings.floors.update');
    });
    Route::middleware([])->prefix('settings')->group(function (){
        Route::get('/', [SettingController::class, 'index'])->name('admin.complex-settings.settings.index');
        Route::get('/edit/{id}', [SettingController::class, 'edit'])->name('admin.complex-settings.settings.edit');
        Route::post('/update/{id}', [SettingController::class, 'update'])->name('admin.complex-settings.settings.update');
    });
    Route::middleware([])->prefix('message-groups')->group(function (){
        Route::get('/', [MessageGroupController::class, 'index'])->name('admin.complex-settings.message-groups.index');
        #
        Route::get('/create/send-to-all', [MessageGroupController::class, 'createSendToAll'])->name('admin.complex-settings.message-groups.create-send-to-all');
        Route::post('/submit/send-to-all', [MessageGroupController::class, 'submitSendToAll'])->name('admin.complex-settings.message-groups.submit-send-to-all');
        #
        Route::get('/create/floor', [MessageGroupController::class, 'createFloor'])->name('admin.complex-settings.message-groups.create-floor');
        Route::post('/submit/floor', [MessageGroupController::class, 'submitFloor'])->name('admin.complex-settings.message-groups.submit-floor');
        #
        Route::get('/create/tenant-type', [MessageGroupController::class, 'createTenantType'])->name('admin.complex-settings.message-groups.create-tenant-type');
        Route::post('/submit/tenant-type', [MessageGroupController::class, 'submitTenantType'])->name('admin.complex-settings.message-groups.submit-tenant-type');
        #
        Route::get('/create/single-tenant', [MessageGroupController::class, 'createSingleTenant'])->name('admin.complex-settings.message-groups.create-single-tenant');
        Route::post('/submit/single-tenant', [MessageGroupController::class, 'submitSingleTenant'])->name('admin.complex-settings.message-groups.submit-single-tenant');
        #
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
    Route::any('/destroy/{id}', [WarningController::class, 'destroy'])->name('admin.warnings.destroy');
});
#
Route::middleware(['auth:admin'])->prefix('exports')->group(function (){
    Route::get('/debt', [ExportController::class, 'debt'])->name('admin.exports.debt');
    Route::get('/other-debt', [ExportController::class, 'otherDebt'])->name('admin.exports.other-debt');
    Route::get('/power-outage', [ExportController::class, 'powerOutage'])->name('admin.exports.power-outage');
});
