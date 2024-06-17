<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LandingController;

use App\Http\Controllers\PostinganController;


// Route untuk halaman landing
Route::get('/', [LandingController::class, 'index']);

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', function () {
    return view('register');
})->name('register');

Route::post('/register', [AuthController::class, 'register']);

// // Route untuk upload foto
// Route::post('/upload-foto', 'FotoController@uploadFoto');

// Route::get('/homepage', function () {
//     return view('homepage');
// });

use App\Http\Controllers\Auth\RegisterController;

Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);


Route::get('/homepage', [PostinganController::class, 'index']);

Route::get('/homepage', [PostinganController::class, 'index'])->name('homepage');

// Route ketika menambahkan postingan
Route::post('/post', [PostinganController::class, 'store'])->name('post.store');

// Route untuk menghapus postingan
Route::delete('/post/{id}', [PostinganController::class, 'destroy'])->name('post.destroy');