<?php

namespace App\Http\Controllers;
use App\Models\User;


use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function show($username)
    {
        // Logic untuk mendapatkan data pengguna berdasarkan username
        $user = User::where('username', $username)->firstOrFail();
        
        // Return view dengan data pengguna
        return view('profile', ['user' => $user]);
    }
}
