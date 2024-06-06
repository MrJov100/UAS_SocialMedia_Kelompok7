<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;


// Route untuk halaman beranda
Route::get('/', [HomeController::class, 'index']);

// Route untuk halaman profil pengguna
Route::get('/profile/{username}', [ProfileController::class, 'show'])->name('profile.show');

// Route untuk upload foto
Route::post('/upload-foto', 'FotoController@uploadFoto');

Route::get('/', function () {
    return view('homepage');
});

Route::get('/homepage', function () {
    return view('homepage');
});

