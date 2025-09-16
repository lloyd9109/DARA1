<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RecoveryController;
use App\Http\Controllers\HomeController; // Import HomeController

// ----------------------------------------
// Guest routes → only for guests
// Prevent back history so logged-in users can't see these pages
// ----------------------------------------
Route::middleware(['guest', 'preventBackHistory'])->group(function () {

    // Landing page
    Route::get('/', function () {
        return view('guest.main'); // main.blade.php
    })->name('landing');

    // Login page
    Route::get('/auth/login', [LoginController::class, 'showLoginForm'])
        ->name('login.page');

    Route::post('/auth/login', [LoginController::class, 'authenticate'])
        ->name('login');

    // Recovery pages
    Route::get('/auth/recovery', [RecoveryController::class, 'showRecoverForm'])
    ->name('recover');


    Route::post('/recovery/email', [RecoveryController::class, 'sendRecoveryEmail'])
        ->name('recovery.email');
});

// ----------------------------------------
// Authenticated routes → only for logged-in users
// Prevent back history so logged-out users cannot access these pages
// ----------------------------------------
Route::middleware(['auth', 'preventBackHistory'])->group(function () {

    Route::get('/home', [HomeController::class, 'index'])->name('home');

    // Logout
    Route::post('/logout', [LoginController::class, 'logout'])
        ->name('logout');

    // Role-based dashboards
    Route::get('/admin', [LoginController::class, 'adminDashboard'])
        ->name('admin.dashboard');

    Route::get('/teacher', [LoginController::class, 'teacherDashboard'])
        ->name('teacher.dashboard');

    Route::get('/student', [LoginController::class, 'studentDashboard'])
        ->name('student.dashboard');
});



// Show recovery form (GET)
Route::get('/recovery', [RecoveryController::class, 'showRecoverForm'])->name('recovery.form');

// Handle recovery form (POST)
Route::post('/recovery/email', [RecoveryController::class, 'sendRecovery'])->name('recovery.email');