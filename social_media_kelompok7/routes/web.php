<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SignupController;
use App\Http\Controllers\ProfileController;


// Route untuk halaman beranda
Route::get('/', [LoginController::class, 'index']);

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

Route::get('/signup', [SignupController::class, 'showRegistrationForm'])->name('signup');
Route::post('/signup', [SignupController::class, 'register']);

// Route untuk halaman profil pengguna
Route::get('/profile/{username}', [ProfileController::class, 'show'])->name('profile.show');

// Route untuk upload foto
Route::post('/upload-foto', 'FotoController@uploadFoto');

Route::get('/homepage', function () {
    return view('homepage');
});

//Route untuk logout
Route::post('/logout', function () {
    Auth::logout();
    return redirect('/login');
})->name('logout');

//route untuk ke profile user
Route::get('/profile', [ProfileController::class, 'show'])->name('profile')->middleware('auth');
