<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\TenantController;
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
    Route::get('/destroy/{id}', [TenantController::class, 'destroy'])->name('admin.tenants.destroy');
});
