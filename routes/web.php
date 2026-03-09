<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('homepage');
});

Route::middleware(['auth','role:admin'])->group(function () {
    Route::get('/admin', function () {
        return "Halaman Admin";
    });
});

Route::middleware(['auth','role:dosen'])->group(function () {
    Route::get('/dosen', function () {
        return "Halaman Dosen";
    });
});

Route::middleware(['auth','role:user'])->group(function () {
    Route::get('/user', function () {
        return "Halaman User";
    });
});

Route::get('/login',[AuthController::class,'loginForm'])->name('login');
Route::get('/register',[AuthController::class,'registerForm'])->name('register');
Route::post('/login',[AuthController::class,'login']);

Route::post('/register',[AuthController::class,'register']);
Route::post('/logout',[AuthController::class,'logout'])->middleware('auth');