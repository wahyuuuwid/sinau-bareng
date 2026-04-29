<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MateriController;
use App\Http\Controllers\DashboardUserController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\AIController;

// 1. GUEST ROUTES (Bisa diakses tanpa login)
Route::get('/', function () {
    return view('homepage');
});

Route::get('/auth/login', [AuthController::class, 'loginForm'])->name('login');
Route::get('/auth/register', [AuthController::class, 'registerForm'])->name('register');
Route::post('/auth/login', [AuthController::class, 'login']);
Route::post('/auth/register', [AuthController::class, 'register']);

// 2. PASSWORD RESET ROUTES
Route::get('/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('/reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset-password', [ResetPasswordController::class, 'reset'])->name('password.update');

// 3. AUTH ROUTES (Harus Login)
Route::middleware(['auth'])->group(function () {
    
    // LOGOUT
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // ROLE: ADMIN
    Route::middleware(['role:admin'])->group(function () {
        Route::get('/admin', function () { return view('pages.admin.dashboard'); });
    });

    // ROLE: DOSEN
    Route::middleware(['role:dosen'])->group(function () {
        Route::get('/dosen', function () { return view('pages.dosen.dashboard'); });
    });

    // ROLE: USER/MAHASISWA
    Route::middleware(['role:user'])->group(function () {
        
        // DASHBOARD (Sekarang sudah lewat Controller!)
        Route::get('/student/dashboard', [DashboardUserController::class, 'index'])->name('user.dashboard');

        // MATERI
        // Route::get('/materi', function() { return view('pages.user.materi'); })->name('materi.index');
        Route::get('/student/materi/cari', [MateriController::class, 'cari'])->name('materi.cari');
        Route::get('/student/materi/saya', [MateriController::class, 'index'])->name('materi.index');
        Route::get('/student/materi/unggah', [MateriController::class, 'create'])->name('materi.create');
        Route::post('/student/materi/unggah', [MateriController::class, 'store'])->name('materi.store');

        // GENERATE SOAL
        Route::get('/student/generate-soal', function () { return view('pages.user.generate'); })->name('generate');

        Route::post('/generate-soal', [AIController::class, 'generateSoal'])->name('soal.generate');
    });

    // MATERI
    Route::get('/get-dosen/{id}', [MateriController::class, 'getDosenByMk'])->name('get.dosen');
});