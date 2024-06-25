<?php

use App\Http\Controllers\Tenant\TransactionController;
use Illuminate\Support\Facades\Route;

Route::get('/' , function () {
    return view('frontend.index');
})->name('home');

Route::any('/transaction-verify', [TransactionController::class, 'verify'])->name('web.verify');
