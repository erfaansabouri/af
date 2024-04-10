<?php

use App\Http\Controllers\Admin\AuthController;
use Illuminate\Support\Facades\Route;


Route::get('/login', [AuthController::class, 'loginForm'])->name('admin.auth.login-form');
Route::post('/login', [AuthController::class, 'login'])->name('admin.auth.login');
Route::get('/logout', [AuthController::class, 'logout'])->name('admin.auth.logout');
