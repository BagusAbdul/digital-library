<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\PeminjamanController;

// Guest Routes
Route::middleware('guest')->group(function () {
    Route::get('/', fn() => view('auth.login'))->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.store');
});

// Authenticated Routes
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Admin Area
    Route::middleware('role:Administrator')->prefix('admin')->group(function () {
        Route::get('/dashboard', fn() => view('admin.dashboard'))->name('admin.dashboard');
        Route::resource('users', UserController::class);
        Route::resource('kategori', KategoriController::class)->except(['show', 'edit', 'create']);

    });
    // Petugas Area
    Route::middleware('role:Petugas,Administrator')->prefix('petugas')->group(function () {
        Route::get('/dashboard', fn() => view('petugas.dashboard'))->name('petugas.dashboard');
        Route::resource('buku', BukuController::class);
        Route::resource('peminjaman', PeminjamanController::class);
    });

    // Peminjam Area
    Route::middleware('role:Peminjam')->prefix('peminjam')->group(function () {
        Route::get('/dashboard', fn() => view('peminjam.dashboard'))->name('peminjam.dashboard');

    });
});
