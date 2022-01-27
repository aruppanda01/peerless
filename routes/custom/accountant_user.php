<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Users\AccountantUser\AccountantUserController;
use App\Http\Controllers\Users\AccountantUser\LoanController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth','accountant_user']], function () {
    Route::get('profile', [AccountantUserController::class,'index'])->name('profile');
    Route::get('change-password', [AccountantUserController::class, 'changePassword'])->name('changePassword');
    Route::post('update-password', [AccountantUserController::class, 'updatePassword'])->name('updatePassword');

    Route::resource('loan',LoanController::class);
    Route::post('revert-back-to-operation',[LoanController::class,'revertBackToOperation'])->name('revertBackToOperation');
    Route::post('revert-back-to-credit',[LoanController::class,'revertBackToCredit'])->name('revertBackToCredit');
    Route::get('generate-pdf/{id}', [LoanController::class, 'generatePDF'])->name('generatePDF');
});