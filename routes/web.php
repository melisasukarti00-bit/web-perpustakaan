<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\PetugasController;
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\KepalaController;
use App\Http\Controllers\PeminjamanController;

// =====================
// HALAMAN UTAMA
// =====================
Route::get('/', function () {
    return view('welcome');
});

// =====================
// AUTH
// =====================
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/login', [AuthController::class, 'login'])->name('login.proses');

Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::post('/register', [AuthController::class, 'register'])->name('register.proses');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


// =====================
// ANGGOTA
// =====================
Route::middleware(['auth', 'role:anggota'])
->prefix('anggota')
->name('anggota.')
->group(function () {

    Route::get('/dashboard', [AnggotaController::class, 'dashboard'])->name('dashboard');

    Route::get('/katalog', [AnggotaController::class, 'katalog'])->name('katalog');

    Route::post('/pinjam/{id}', [AnggotaController::class, 'pinjam'])->name('pinjam');

    Route::get('/peminjaman', [PeminjamanController::class, 'peminjaman'])->name('peminjaman');

    Route::get('/pengembalian', [AnggotaController::class, 'pengembalian'])
    ->name('pengembalian');

    Route::post('/kembalikan/{id}', [PeminjamanController::class, 'kembalikan'])
    ->name('kembalikan');
    
    // PROFILE 
    Route::get('/profile', [AnggotaController::class, 'profile'])->name('profile');
    Route::post('/profile', [AnggotaController::class, 'updateProfile'])->name('profile.update');
});


// =====================
// PETUGAS
// =====================
Route::middleware(['auth', 'role:petugas']) 
->prefix('petugas')
->name('petugas.')
->group(function (){

    Route::get('/dashboard', [PetugasController::class, 'dashboard'])->name('dashboard');

    Route::get('/anggota', [PetugasController::class, 'anggota'])->name('anggota'); 

    Route::resource('buku', BukuController::class);

    // 🔹 lihat peminjaman & pengembalian
    Route::get('/peminjaman', [PeminjamanController::class, 'indexPetugas'])
        ->name('peminjaman');

    // 🔹 konfirmasi peminjaman
    Route::post('/peminjaman/{id}/konfirmasi', [PeminjamanController::class, 'konfirmasi'])
        ->name('peminjaman.konfirmasi');

    // 🔹 konfirmasi pengembalian
    Route::post('/peminjaman/{id}/kembali', [PeminjamanController::class, 'konfirmasiPengembalian'])
        ->name('peminjaman.kembali');
});

    


// =====================
// KEPALA
// =====================
Route::middleware(['auth', 'role:kepala'])
    ->prefix('kepala')
    ->name('kepala.')
    ->group(function () {

        // Halaman dashboard
        Route::get('/dashboard', [KepalaController::class, 'dashboard'])->name('dashboard');

        // Halaman laporan peminjaman
        Route::get('/laporan', [KepalaController::class, 'laporan'])->name('laporan');

        // Halaman buku dan petugas
        Route::get('/buku', [KepalaController::class, 'dataBuku'])->name('buku');

        Route::prefix('petugas')->name('petugas.')->group(function () {
            Route::get('/', [KepalaController::class, 'index'])->name('index');
            Route::get('/create', [KepalaController::class, 'create'])->name('create');
            Route::post('/store', [KepalaController::class, 'store'])->name('store');
            Route::get('/{id}/edit', [KepalaController::class, 'edit'])->name('edit');
            Route::put('/{id}', [KepalaController::class, 'update'])->name('update');
            Route::delete('/{id}', [KepalaController::class, 'destroy'])->name('destroy');
        });

});