<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RecoveryController;

// ----------------------------------------
// Root route → show main.blade.php
// ----------------------------------------
Route::get('/', function () {
    return view('guest.main'); // resources/views/guest/main.blade.php
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
Route::get('/recover', [RecoveryController::class, 'showRecoverForm'])
    ->name('recover');

Route::post('/recovery/email', [RecoveryController::class, 'sendRecoveryEmail'])
    ->name('recovery.email');

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
