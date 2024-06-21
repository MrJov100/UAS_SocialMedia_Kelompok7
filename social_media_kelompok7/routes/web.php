<?php

use App\Http\Controllers\CommentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LandingController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PostinganController;
use App\Http\Controllers\BerandaController;


// Route untuk halaman landing
Route::get('/', [LandingController::class, 'index']);

// Route untuk ke beranda, menggunakan PostinganController@index
Route::get('/beranda', [PostinganController::class, 'index'])->middleware('auth')->name('beranda');

//untuk login
Route::get('/login', function () {
    return view('login');
})->name('login');

Route::post('/login', [AuthController::class, 'login']);

//untuk logout
Route::post('/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/login');
})->middleware('auth');

//untuk register
Route::get('/register', function () {
    return view('register');
})->name('register');

Route::post('/register', [AuthController::class, 'register']);

//route untuk ke profile user
Route::get('/profile', [ProfileController::class, 'show'])->name('profile')->middleware('auth');

// Route ketika menambahkan postingan
Route::post('/post', [PostinganController::class, 'store'])->name('post.store');

// Route untuk menghapus postingan
Route::delete('/post/{id}', [PostinganController::class, 'destroy'])->name('post.destroy');

Route::put('/postingan/{id}', [PostinganController::class, 'update'])->name('postingan.update');

Route::post('/profile/picture', [ProfileController::class, 'updateProfilePicture'])->name('profile.picture.update');

Route::post('post/like/{id}', [LikeController::class, 'likePost'])->name('like.post');

Route::post("/post/comment/{postId}", [CommentController::class, "store"])->name('comment.store');
Route::post('/comment/{id}', [CommentController::class, "update"])->name('comment.update');
Route::delete('/comment/{id}', [CommentController::class, "destroy"])->name('comment.destroy');
