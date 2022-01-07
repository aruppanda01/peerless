<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Users\CreditUser\CreditUserController;
use App\Http\Controllers\Users\CreditUser\LoanController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth','credit_user']], function () {
    Route::get('profile', [CreditUserController::class,'index'])->name('profile');
    Route::get('change-password', [CreditUserController::class, 'changePassword'])->name('changePassword');
    Route::post('update-password', [CreditUserController::class, 'updatePassword'])->name('updatePassword');

    Route::resource('loan',LoanController::class);
    Route::get('failed-loan-details', [LoanController::class, 'failedLoanDetails'])->name('failedLoanDetails');
    Route::get('failed-loan-details/show/{id}', [LoanController::class, 'failedLoanDetailsShow'])->name('failedLoanDetailsShow');
    Route::get('failed-loan-details/edit/{id}', [LoanController::class, 'failedLoanDetailsEdit'])->name('failedLoanDetailsEdit');
    Route::put('failed-loan-details/update/{id}', [LoanController::class, 'failedLoanDetailsUpdate'])->name('failedLoanDetailsUpdate');
});