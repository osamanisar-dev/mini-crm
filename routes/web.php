<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Auth\EmployeeAuthController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\EmployeeDashboard\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MailOTP\OtpPasswordResetController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::post('/admin/logout', [LoginController::class, 'userLogout'])->name('user.logout');


Route::group(['prefix' => 'employee'], function () {
//    Authenticate Employee
    Route::group(['middleware' => 'employee.guest'], function () {
        Route::view('/login', 'employeesec.login')->name('employee.login');
        Route::post('login', [EmployeeAuthController::class, 'authenticate'])->name('employee.auth');

        Route::get('/password/reset-otp', [OtpPasswordResetController::class, 'showResetOtpForm'])->name('password.reset-otp');
        Route::post('/password/send-otp', [OtpPasswordResetController::class, 'sendOtp'])->name('password.send-otp');
        Route::post('/password/reset-with-otp', [OtpPasswordResetController::class, 'resetWithOtp'])->name('password.reset-with-otp');

    });
//    If employee success Login
    Route::group(['middleware' => 'employee.auth'], function () {
        Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('employee.dashboard');
        Route::get('/profile', [DashboardController::class, 'profile'])->name('view.employee.profile');
        Route::post('/profile/update', [DashboardController::class, 'update'])->name('employee.self.update');
        Route::get('/chat/{id}', [DashboardController::class, 'message'])->name('emp_msg');
        Route::post('/broadcast', [DashboardController::class, 'broadcast']);
        Route::post('/receive', [DashboardController::class, 'receive']);

        Route::get('/logout', [EmployeeAuthController::class, 'logout'])->name('employee.logout');
    });
});




Route::post('register-admin',[AdminController::class,'register'])->name('register-admin');

Route::middleware('checkLogin')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.index');
});

Route::middleware('preventLogin')->group(function () {
    Route::get('login-form',[AdminController::class,'loginForm'])->name('login-form');
    Route::post('login-admin',[AdminController::class,'login'])->name('login-admin');
});



