<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\DashboardController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth','admin']], function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('credit-user', CreditUserController::class);
    Route::resource('operation-user', OperationUserController::class);
    Route::resource('accountant-user', AccountantUserController::class);

    // Credit User Functionality
    Route::put('/approve-user/{id}', [CreditUserController::class, 'approval'])->name('credit-user.approve');
    Route::put('/deactivate-user/{id}', [CreditUserController::class, 'deactivate_account'])->name('credit-user.deactivate');
    Route::put('/activate-user/{id}', [CreditUserController::class, 'activate_account'])->name('credit-user.activate');

    // Operation User Functionality
    Route::put('/approve-operation-user/{id}', [OperationUserController::class, 'approval'])->name('operation-user.approve');
    Route::put('/deactivate-operation-user/{id}', [OperationUserController::class, 'deactivate_account'])->name('operation-user.deactivate');
    Route::put('/activate-operation-user/{id}', [OperationUserController::class, 'activate_account'])->name('operation-user.activate');

    // Account User Functionality
    Route::put('/approve-accountant-user/{id}', [AccountantUserController::class, 'approval'])->name('accountant-user.approve');
    Route::put('/deactivate-accountant-user/{id}', [AccountantUserController::class, 'deactivate_account'])->name('accountant-user.deactivate');
    Route::put('/activate-accountant-user/{id}', [AccountantUserController::class, 'activate_account'])->name('accountant-user.activate');
});