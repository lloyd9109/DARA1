<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RecoveryController;

// ----------------------------------------
// Root route → show main.blade.php
// ----------------------------------------
Route::get('/', function () {
    return view('guest.main'); 
})->name('landing');

// ----------------------------------------
// Home page (after login)
// ----------------------------------------
Route::get('/home', [LoginController::class, 'home'])
    ->middleware('auth')
    ->name('home');

// ----------------------------------------
// Login routes
// ----------------------------------------
Route::get('/auth/login', [LoginController::class, 'showLoginForm'])
    ->name('login.page');

Route::post('/auth/login', [LoginController::class, 'authenticate'])
    ->name('login');

Route::post('/logout', [LoginController::class, 'logout'])
    ->name('logout');

// ----------------------------------------
// Recovery routes
// ----------------------------------------
Route::get('/auth/recovery', [RecoveryController::class, 'showRecoverForm'])
    ->name('recovery');

Route::get('/auth/recovery_confirmation', [RecoveryController::class, 'sendRecoveryEmail'])
    ->name('recovery_confirmation');

Route::get('/auth/verify_otp', [RecoveryController::class, 'VerifyOTP'])
    ->name('verfity_otp');
Route::get('/auth/reset_password', [RecoveryController::class, 'ResetPassword'])
    ->name('reset_password');


// ----------------------------------------
// Role-based dashboards
// ----------------------------------------
Route::middleware('auth')->group(function () {
    Route::get('/admin', [LoginController::class, 'adminDashboard'])
        ->name('admin.dashboard');

    Route::get('/teacher', [LoginController::class, 'teacherDashboard'])
        ->name('teacher.dashboard');

    Route::get('/student', [LoginController::class, 'studentDashboard'])
        ->name('student.dashboard');
});
