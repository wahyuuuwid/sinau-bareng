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
use App\Http\Controllers\AdminController;

// ==========================================
// 1. GUEST ROUTES (Tanpa Login)
// ==========================================
Route::get('/', function () {
    return view('homepage');
});

Route::prefix('auth')->group(function () {
    Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'registerForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::prefix('forgot-password')->group(function () {
    Route::get('/', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
    Route::post('/', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
});

Route::get('/reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset-password', [ResetPasswordController::class, 'reset'])->name('password.update');


// ==========================================
// 2. AUTHENTICATED ROUTES (Harus Login)
// ==========================================
Route::middleware(['auth', 'nocache'])->group(function () {

    // LOGOUT ACTION
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // INDUK PREFIX: /student (Semua yang berbau mahasiswa kumpul di sini)
    Route::prefix('student')->group(function () {
        
        // Profil Mahasiswa
        Route::prefix('profile')->name('profile.')->group(function () {
            Route::get('/', [ProfileController::class, 'index'])->name('index');
            Route::patch('/', [ProfileController::class, 'update'])->name('update');
            Route::put('/password', [ProfileController::class, 'updatePassword'])->name('password'); 
            Route::delete('/', [ProfileController::class, 'destroy'])->name('destroy');
        });

        // Modul Manajemen Materi (Custom Prefix & Name Grouping)
        Route::prefix('materi')->name('materi.')->group(function () {
            Route::get('/cari', [MateriController::class, 'cari'])->name('cari');
            Route::get('/saya', [MateriController::class, 'myMateri'])->name('saya');
            Route::get('/unggah', [MateriController::class, 'create'])->name('create');
            Route::post('/unggah', [MateriController::class, 'store'])->name('store');
            Route::post('/rate/{id}', [MateriController::class, 'rate'])->name('rate'); // Rating masuk modul materi
        });

        // Fitur Generate Soal AI
        Route::get('/dashboard', [DashboardUserController::class, 'index'])->name('user.dashboard');
        Route::get('/generate-soal', function () { return view('pages.user.generate'); })->name('generate');
    });

    // ACTION UTAMA GENERATE AI
    Route::post('/generate-soal', [AIController::class, 'generateSoal'])->name('soal.generate');


    // ==========================================
    // 3. ROLE-BASED MULTI-TENANT ROUTES
    // ==========================================
    // ROLE: ADMIN
     Route::middleware(['role:admin'])->prefix('admin')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
        
        // Kelola Pengguna
        Route::get('/kelola-pengguna', [AdminController::class, 'manageUsers'])->name('admin.users');
        Route::post('/users', [AdminController::class, 'storeUser'])->name('admin.users.store');
        Route::put('/users/{id}', [AdminController::class, 'updateUser'])->name('admin.users.update');
        Route::delete('/users/{id}', [AdminController::class, 'deleteUser'])->name('admin.users.delete');
        Route::post('/users/store', [AdminController::class, 'storeUser'])->name('admin.users.store');

        // Manajemen Laporan
        Route::get('/manajemen-laporan', [AdminController::class, 'manageLaporan'])->name('admin.laporan');
        Route::post('/laporan/{id}/ignore', [AdminController::class, 'ignoreReport'])->name('admin.laporan.ignore');
        Route::delete('/laporan/{id}/delete', [AdminController::class, 'deleteReportedMateri'])->name('admin.laporan.delete');

        // Moderasi Konten (BARU)
        Route::get('/moderasi-konten', [AdminController::class, 'manageModeration'])->name('admin.moderation');
        Route::put('/materi/{id}/update', [AdminController::class, 'updateMateri'])->name('admin.materi.update');
        Route::delete('/moderation/{id}/delete', [AdminController::class, 'deleteContent'])->name('admin.moderation.delete');

        //PROFIL ADMIN
        Route::get('/profile', [AdminController::class, 'profile'])->name('admin.profile');
        Route::put('/profile/update', [AdminController::class, 'updateProfile'])->name('admin.profile.update');
        Route::put('/profile/password', [AdminController::class, 'updatePassword'])->name('admin.profile.password');
    });

    // ROLE: DOSEN
    Route::middleware(['role:dosen'])->prefix('dosen')->name('dosen.')->group(function () {
        Route::get('/', [DosenController::class, 'index'])->name('dashboard');
        Route::get('/validasi-materi', [DosenController::class, 'validasiMateri'])->name('validasi');
        Route::get('/materi/{id}', [DosenController::class, 'showMateri'])->name('materi.show');
        Route::patch('/materi/{id}/update', [DosenController::class, 'updateStatus'])->name('materi.update');
    });
});