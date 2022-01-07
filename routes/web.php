<?php

use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('land_page');

Auth::routes();

Route::any('admin/login', [LoginController::class, 'admin_login'])->name('admin_login');
Route::any('operation/login', [LoginController::class, 'operation_login'])->name('operation_login');
Route::any('accountant/login', [LoginController::class, 'accountant_login'])->name('accountant_login');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

/**
 * Notification
 */
// Notification
Route::post('/read', [NotificationController::class, 'notificationRead'])->name('notification.read');

Route::get('hr/notification', [NotificationController::class, 'logsNotification'])->name('logs.notification');
Route::get('student/notification', [NotificationController::class, 'logsNotificationForStudentEvent'])->name('student.logs.notification');
Route::get('teacher/notification', [NotificationController::class, 'logsNotificationForTeacher'])->name('teacher.logs.notification');
Route::post('hr/notification/readall', [NotificationController::class, 'notificationReadAll'])->name('logs.notification.readall');

Route::group(['as' => 'admin.', 'prefix' => 'admin'], function () {
    require 'custom/admin.php';
});

Route::group(['as' => 'credit_user.', 'prefix' => 'credit_user'], function () {
    require 'custom/credit_user.php';
});

Route::group(['as' => 'operation_user.', 'prefix' => 'operation_user'], function () {
    require 'custom/operation_user.php';
});

Route::group(['as' => 'accountant_user.', 'prefix' => 'accountant_user'], function () {
    require 'custom/accountant_user.php';
});
