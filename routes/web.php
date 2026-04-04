<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\PetugasController;



// halaman utama (melibrary)
Route::get('/', [AuthController::class, 'index']);

// login
Route::get('/login', [AuthController::class, 'showLogin']);
Route::post('/login', [AuthController::class, 'login']);

// register
Route::get('/register', [AuthController::class, 'showRegister']);
Route::post('/register', [AuthController::class, 'register']);

// logout
Route::get('/logout', [AuthController::class, 'logout']);

Route::prefix('petugas')->name('petugas.')->group(function () {

    Route::get('/dashboard', [PetugasController::class, 'dashboard'])
        ->name('dashboard');

     // 🔹 PROFILE
    Route::get('/profile', function () {
        return view('petugas.profile');
    })->name('profile');
    
    Route::resource('buku', BukuController::class);

});