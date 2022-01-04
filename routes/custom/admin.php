<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\DashboardController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth','admin']], function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('credit-user', CreditUserController::class);

    Route::put('/approve-user/{id}', [CreditUserController::class, 'approval'])->name('credit-user.approve');
    Route::put('/deactivate-user/{id}', [CreditUserController::class, 'deactivate_account'])->name('credit-user.deactivate');
    Route::put('/activate-user/{id}', [CreditUserController::class, 'activate_account'])->name('credit-user.activate');
});