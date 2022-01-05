<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Users\CreditUser\CreditUserController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth']], function () {
    Route::get('profile', [CreditUserController::class,'index'])->name('profile');
});