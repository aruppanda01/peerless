<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Users\CreditUser\CreditUserController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth','credit_user']], function () {
    Route::get('profile', [CreditUserController::class,'index'])->name('profile');
    Route::get('change-password', [CreditUserController::class, 'changePassword'])->name('changePassword');
    Route::post('update-password', [CreditUserController::class, 'updatePassword'])->name('updatePassword');
});