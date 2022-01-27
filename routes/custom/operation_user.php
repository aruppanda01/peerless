<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Users\OperationUser\LoanController;
use App\Http\Controllers\Users\OperationUser\OperationUserController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth','operation_user']], function () {
    Route::get('profile', [OperationUserController::class,'index'])->name('profile');
    Route::get('change-password', [OperationUserController::class, 'changePassword'])->name('changePassword');
    Route::post('update-password', [OperationUserController::class, 'updatePassword'])->name('updatePassword');

    Route::resource('loan',LoanController::class);
    Route::post('revert-back',[LoanController::class,'revertBack'])->name('revertBack');

    Route::get('failed-loan-details', [LoanController::class, 'failedLoanDetails'])->name('failedLoanDetails');
    Route::get('failed-loan-details/show/{id}', [LoanController::class, 'failedLoanDetailsShow'])->name('failedLoanDetailsShow');
    Route::get('failed-loan-details/edit/{id}', [LoanController::class, 'failedLoanDetailsEdit'])->name('failedLoanDetailsEdit');
    Route::put('failed-loan-details/update/{id}', [LoanController::class, 'failedLoanDetailsUpdate'])->name('failedLoanDetailsUpdate');
    Route::get('generate-pdf/{id}', [LoanController::class, 'generatePDF'])->name('generatePDF');
});