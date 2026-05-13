<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardUserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\MateriController;
use App\Http\Controllers\AIController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;

Route::get('/', function () { return view('homepage'); });

Route::get('/auth/login', [AuthController::class, 'loginForm'])->name('login');
Route::get('/auth/register', [AuthController::class, 'registerForm'])->name('register');
Route::post('/auth/login', [AuthController::class, 'login']);
Route::post('/auth/register', [AuthController::class, 'register']);

// PASSWORD RESET ROUTES
Route::get('/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('/reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset-password', [ResetPasswordController::class, 'reset'])->name('password.update');

Route::middleware(['auth'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // =========================================================
    // ENKAPSULASI ROLE: ADMIN
    // =========================================================
    Route::middleware(['role:admin'])->prefix('admin')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
        
        // Kelola Pengguna
        Route::get('/users', [AdminController::class, 'manageUsers'])->name('admin.users');
        Route::post('/users', [AdminController::class, 'storeUser'])->name('admin.users.store');
        Route::put('/users/{id}', [AdminController::class, 'updateUser'])->name('admin.users.update');
        Route::delete('/users/{id}', [AdminController::class, 'deleteUser'])->name('admin.users.delete');
        Route::post('/users/store', [AdminController::class, 'storeUser'])->name('admin.users.store');

        // Manajemen Laporan
        Route::get('/laporan', [AdminController::class, 'manageLaporan'])->name('admin.laporan');
        Route::post('/laporan/{id}/ignore', [AdminController::class, 'ignoreReport'])->name('admin.laporan.ignore');
        Route::delete('/laporan/{id}/delete', [AdminController::class, 'deleteReportedMateri'])->name('admin.laporan.delete');

        // Moderasi Konten (BARU)
        Route::get('/moderation', [AdminController::class, 'manageModeration'])->name('admin.moderation');
        Route::delete('/moderation/{id}/delete', [AdminController::class, 'deleteContent'])->name('admin.moderation.delete');

        //PROFIL ADMIN
        Route::get('/profile', [AdminController::class, 'profile'])->name('admin.profile');
        Route::put('/profile/update', [AdminController::class, 'updateProfile'])->name('admin.profile.update');
        Route::put('/profile/password', [AdminController::class, 'updatePassword'])->name('admin.profile.password');
    });

    // =========================================================
    // ENKAPSULASI ROLE: DOSEN
    // =========================================================
    Route::middleware(['role:dosen'])->prefix('dosen')->group(function () {
        Route::get('/dashboard', [DosenController::class, 'index'])->name('dosen.dashboard');
        Route::get('/validasi-materi', [DosenController::class, 'validasiMateri'])->name('dosen.validasi');
        Route::get('/materi/{id}', [DosenController::class, 'showMateri'])->name('dosen.materi.show');
        Route::patch('/materi/{id}/update', [DosenController::class, 'updateStatus'])->name('dosen.materi.update');
    });

    // =========================================================
    // ENKAPSULASI ROLE: MAHASISWA
    // =========================================================
    Route::middleware(['role:user'])->prefix('student')->group(function () {
        // Dashboard Utama
        Route::get('/dashboard', [DashboardUserController::class, 'index'])->name('user.dashboard');
    
        // Halaman Cari & Unduh (Global)
        Route::get('/materi/eksplorasi', [MateriController::class, 'index'])->name('materi.eksplorasi');
        Route::get('/materi/cari', [MateriController::class, 'cari'])->name('materi.cari');
    
        // Halaman Materi Saya (Privat) - Menggunakan fungsi mine di DashboardUserController
        Route::get('/materi/saya', [DashboardUserController::class, 'mine'])->name('materi.mine');
    
        // Fitur Materi (Unggah, Detail, Download, dll)
        Route::get('/materi/unggah', [MateriController::class, 'create'])->name('materi.create');
        Route::post('/materi/unggah', [MateriController::class, 'store'])->name('materi.store');
        Route::get('/materi/detail/{id}', [MateriController::class, 'show'])->name('materi.show');
        Route::get('/materi/download/{id}', [MateriController::class, 'download'])->name('materi.download');
        Route::get('/materi/saya', [DashboardUserController::class, 'mine'])->name('materi.mine');
        Route::delete('/materi/{id}', [MateriController::class, 'destroy'])->name('materi.destroy');
    
        // Interaction (Rate & Report)
        Route::post('/materi/rate/{id}', [MateriController::class, 'rate'])->name('materi.rate');
        Route::post('/materi/report/{id}', [MateriController::class, 'report'])->name('materi.report');

        // Fitur AI & Profil
        Route::get('/generate-soal', function () { return view('pages.user.generate'); })->name('generate');
        Route::post('/generate-soal', [AIController::class, 'generateSoal'])->name('soal.generate');
        Route::get('/profile', [ProfileController::class, 'index'])->name('student.profile');
    
        // Helper API
        Route::get('/get-dosen', [MateriController::class, 'getDosen'])->name('student.getDosen');

        //PROFIL MAHASISWA
        Route::get('/profile', [ProfileController::class, 'index'])->name('student.profile');
        Route::put('/profile/update', [ProfileController::class, 'update'])->name('student.profile.update');
        Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('student.profile.password');
        Route::delete('/profile/delete', [ProfileController::class, 'deleteAccount'])->name('student.profile.delete');

        //MANAJEMEN LAPORAN
        Route::get('/laporan', [AdminController::class, 'manageLaporan'])->name('admin.laporan');
        Route::post('/laporan/{id}/ignore', [AdminController::class, 'ignoreReport'])->name('admin.laporan.ignore');
        Route::delete('/laporan/{id}/delete', [AdminController::class, 'deleteReportedMateri'])->name('admin.laporan.delete');
        
    });
});