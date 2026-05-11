<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MateriController;
use App\Http\Controllers\DashboardUserController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\AIController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\ProfileController;

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

    // PROFIL
    Route::get('/student/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::put('/student/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/student/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password');

    // LOGOUT
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // ROLE: ADMIN
    Route::middleware(['auth','role:admin'])->group(function () {
        Route::get('/admin', function () { return view('pages.admin.dashboard'); });
    });

    // ROLE: DOSEN
    Route::middleware(['auth','role:dosen'])->group(function () {
        Route::get('/dosen', [DosenController::class, 'index'])->name('dosen.dashboard');
        Route::get('/dosen/validasi-materi', [DosenController::class, 'validasiMateri'])->name('dosen.validasi');


        Route::get('/dosen/materi/{id}', [DosenController::class, 'showMateri'])->name('dosen.materi.show');
        Route::patch('/dosen/materi/{id}/update', [DosenController::class, 'updateStatus'])->name('dosen.materi.update');
    });

    // ROLE: USER/MAHASISWA
    Route::middleware(['auth','role:user'])->group(function () {
        
        // DASHBOARD (Sekarang sudah lewat Controller!)
        Route::get('/student/dashboard', [DashboardUserController::class, 'index'])->name('user.dashboard');

        // MATERI
        // Route::get('/materi', function() { return view('pages.user.materi'); })->name('materi.index');
        Route::get('/student/materi/cari', [MateriController::class, 'cari'])->name('materi.cari');
        Route::get('/student/materi/saya', [MateriController::class, 'myMateri'])->name('materi.index');
        Route::get('/student/materi/unggah', [MateriController::class, 'create'])->name('materi.create');
        Route::post('/student/materi/unggah', [MateriController::class, 'store'])->name('materi.store');
        Route::get('/student/profile', [ProfileController::class, 'index'])->name('profile.index');
        Route::put('/student/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::put('/student/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password');

        // GENERATE SOAL
        Route::get('/student/generate-soal', function () { return view('pages.user.generate'); })->name('generate');

        Route::post('/generate-soal', [AIController::class, 'generateSoal'])->name('soal.generate');
    });

    // MATERI
    Route::get('/get-dosen/{id}', [MateriController::class, 'getDosenByMk'])->name('get.dosen');

    // RATING
    Route::post('/student/materi/rate/{id}', [MateriController::class, 'rate'])->name('materi.rate');

    // Profile
    Route::middleware('auth')->group(function () {
        Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
        Route::post('/profile/update-name', [ProfileController::class, 'updateName'])->name('profile.updateName');
        Route::post('/profile/update-email', [ProfileController::class, 'updateEmail'])->name('profile.updateEmail');
        Route::delete('/profile/delete', [ProfileController::class, 'deleteAccount'])->name('profile.delete');
    });
});
