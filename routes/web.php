<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\MateriController;


Route::get('/', function () {
    return view('homepage');
});

Route::middleware(['auth','role:admin'])->group(function () {
    Route::get('/admin', function () {
        return view('pages.admin.dashboard');
    });
});

Route::middleware(['auth','role:dosen'])->group(function () {
    Route::get('/dosen', function () {
        return view('pages.dosen.dashboard');
    });
});

Route::middleware(['auth','role:user'])->group(function () {
    Route::get('/user', function () {
        return view('pages.user.dashboard');
    });
});

Route::get('/login',[AuthController::class,'loginForm'])->name('login');
Route::get('/register',[AuthController::class,'registerForm'])->name('register');

Route::post('/login',[AuthController::class,'login']);
Route::post('/register',[AuthController::class,'register']);

Route::post('/logout', [AuthController::class, 'logout'])
->name('logout')
->middleware('auth');


Route::get('/materi', function () {
    return view('pages.user.materi');
})->middleware(['auth'])->name('materi');


// Halaman form input email
Route::get('/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');

// Proses kirim email (POST)
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');


Route::get('/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

Route::get('/reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])
    ->name('password.reset');

Route::post('/reset-password', [ResetPasswordController::class, 'reset'])
    ->name('password.update');

Route::get('/generate', function () {
    return view('pages.user.generate'); 
});

Route::get('materi/cari', function() { 
    return view('pages.user.materi.index');
});

Route::get('materi/unggah', function() { 
    return view('pages.user.materi.create'); 
    });

Route::get('materi/saya', function() {
    return view('pages.user.materi.mine'); 
    });



Route::middleware(['auth'])->group(function () {
    // 1. Halaman Daftar "Materi Saya" (Nampilin Tabel)
    Route::get('materi/saya', [MateriController::class, 'index'])->name('materi.index');

    // 2. Halaman Form "Unggah Materi" (Nampilin Inputan)
    Route::get('materi/unggah', function() { 
        return view('pages.user.materi.create'); 
    })->name('materi.create');

    // 3. Proses Simpan ke Database (Action dari Form)
    Route::post('materi/unggah', [MateriController::class, 'store'])->name('materi.store');
});

