<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RecoveryController;
use App\Http\Controllers\HomeController;

// ----------------------------------------
// Guest routes → only for guests
// ----------------------------------------
Route::middleware(['guest', 'preventBackHistory'])->group(function () {

    // Landing page
    Route::get('/', function () {
        return view('guest.main');
    })->name('landing');

    // Login
    Route::get('/auth/login', [LoginController::class, 'showLoginForm'])->name('login.page');
    Route::post('/auth/login', [LoginController::class, 'authenticate'])->name('login');

    // -------------------------------
    // Forgot Password (Recovery Flow)
    // -------------------------------
    // 1. Enter email
    Route::get('/auth/recovery', [RecoveryController::class, 'showRecoverForm'])->name('password.recover');
    Route::post('/auth/recovery', [RecoveryController::class, 'sendRecovery'])->name('password.recover.send');

    // 2. Verify OTP
    Route::get('/auth/verify-otp', [RecoveryController::class, 'showVerifyOtpForm'])->name('password.verify.form');
    Route::post('/auth/verify-otp', [RecoveryController::class, 'verifyOtp'])->name('password.verify');

    // 3. Reset Password
    Route::get('/auth/reset-password', [RecoveryController::class, 'showResetForm'])->name('password.reset.form');
    Route::post('/auth/reset-password', [RecoveryController::class, 'resetPassword'])->name('password.reset');

    // OTP Resend
    Route::post('/auth/resend-otp', [RecoveryController::class, 'resendOtp'])->name('password.otp.resend');
});

// ----------------------------------------
// Authenticated routes → only for logged-in users
// ----------------------------------------
Route::middleware(['auth', 'preventBackHistory'])->group(function () {

    // ✅ Student Dashboard (Home Page)
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    // ✅ Admin Dashboard
    Route::get('/admin/dashboard', [LoginController::class, 'adminDashboard'])->name('admin.dashboard');

    // ✅ Teacher Dashboard
    Route::get('/teacher/dashboard', [LoginController::class, 'teacherDashboard'])->name('teacher.dashboard');

    // ✅ Logout
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});
