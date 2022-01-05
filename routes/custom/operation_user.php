<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Users\OperationUser\OperationUserController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth','operation_user']], function () {
    Route::get('profile', [OperationUserController::class,'index'])->name('profile');
    Route::get('change-password', [OperationUserController::class, 'changePassword'])->name('changePassword');
    Route::post('update-password', [OperationUserController::class, 'updatePassword'])->name('updatePassword');
});