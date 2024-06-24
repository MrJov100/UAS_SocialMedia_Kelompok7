<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LandingController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PostinganController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\CommentController;

// Route untuk halaman landing
Route::get('/', [LandingController::class, 'index']);

// Route untuk ke beranda, menggunakan PostinganController@index
Route::get('/beranda', [PostinganController::class, 'index'])->middleware('auth')->name('beranda');

// Route untuk login
Route::get('/login', function () {
    return view('login');
})->name('login');

Route::post('/login', [AuthController::class, 'login']);

// Route untuk logout
Route::post('/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/login');
})->middleware('auth');

// Route untuk register
Route::get('/register', function () {
    return view('register');
})->name('register');

Route::post('/register', [AuthController::class, 'register']);

// Route untuk profile user
Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show')->middleware('auth');
Route::get('/profile/settings', [ProfileController::class, 'settings'])->name('profile.settings')->middleware('auth');
Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update')->middleware('auth');
Route::post('/profile/picture', [ProfileController::class, 'updateProfilePicture'])->name('profile.picture.update')->middleware('auth');
Route::put('/profile/updateName', [ProfileController::class, 'updateName'])->name('profile.updateName')->middleware('auth');
Route::put('/profile/updateUsernameEmail', [ProfileController::class, 'updateUsernameEmail'])->name('profile.updateUsernameEmail')->middleware('auth');
Route::put('/profile/updatePassword', [ProfileController::class, 'updatePassword'])->name('profile.updatePassword')->middleware('auth');

// Route ketika menambahkan postingan
Route::post('/post', [PostinganController::class, 'store'])->name('post.store');

// Route untuk menghapus postingan
Route::delete('/post/{id}', [PostinganController::class, 'destroy'])->name('post.destroy');

Route::put('/postingan/{id}', [PostinganController::class, 'update'])->name('postingan.update');

// Route untuk menyukai postingan
Route::post('post/like/{id}', [LikeController::class, 'likePost'])->name('like.post');

// Route untuk menambahkan komentar
Route::post("/post/comment/{postId}", [CommentController::class, "store"])->name('comment.store');
Route::post('/comment/{id}', [CommentController::class, "update"])->name('comment.update');
Route::delete('/comment/{id}', [CommentController::class, "destroy"])->name('comment.destroy');
