<?php

use App\Http\Controllers\Tenant\TransactionController;
use Illuminate\Support\Facades\Route;

Route::get('/' , function () {
    return redirect()->route('tenant.auth.login');
});

Route::any('/transaction-verify', [TransactionController::class, 'verify'])->name('web.verify');
