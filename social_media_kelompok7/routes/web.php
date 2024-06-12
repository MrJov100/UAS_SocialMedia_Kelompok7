<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SignupController;



// Route untuk halaman beranda
Route::get('/', [LoginController::class, 'index']);

Route::get('/signup', [SignupController::class, 'showRegistrationForm'])->name('signup');
Route::post('/signup', [SignupController::class, 'register']);

// Route untuk halaman profil pengguna
Route::get('/profile/{username}', [ProfileController::class, 'show'])->name('profile.show');

// Route untuk upload foto
Route::post('/upload-foto', 'FotoController@uploadFoto');

Route::get('/homepage', function () {
    return view('homepage');
});