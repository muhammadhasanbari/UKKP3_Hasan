<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PenggunaController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\AdminLaporanController;

Route::middleware('guest')->group(function () {
    Route::get('/', [AuthController::class, 'showLogin'])
        ->name('login');

    Route::get('/register', [AuthController::class, 'showRegister'])
        ->name('register');

    Route::post('/login', [AuthController::class, 'login'])
        ->name('login.attempt');

    Route::post('/register', [AuthController::class, 'register'])
        ->name('register.store');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('logout');

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    Route::get('/dashboard/admin', [DashboardController::class, 'admin'])
        ->middleware('role:admin')
        ->name('dashboard.admin');

    Route::get('/dashboard/user', [DashboardController::class, 'user'])
        ->middleware('role:user')
        ->name('dashboard.user');

    Route::get('/profil', [DashboardController::class, 'profil'])
        ->name('profil');
        
    
    Route::middleware('role:admin')
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/laporan', [AdminLaporanController::class, 'index'])
            ->name('laporan.index');
    });


    // CRUD pengguna hanya untuk admin
    Route::middleware('role:admin')
        ->prefix('admin')
        ->name('admin.')
        ->group(function () {
            Route::resource('pengguna', PenggunaController::class)
                ->except(['show']);
        });
});
// Laporan pengaduan untuk user yang login
Route::middleware('role:user')->group(function () {
    Route::get('/laporan', [LaporanController::class, 'index'])
        ->name('laporan.index');

    Route::get('/laporan/create', [LaporanController::class, 'create'])
        ->name('laporan.create');

    Route::post('/laporan', [LaporanController::class, 'store'])
        ->name('laporan.store');
});

