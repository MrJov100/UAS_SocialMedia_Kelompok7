<?php

namespace App\Http\Controllers;
use App\Models\User;


use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index()
    {
        return view('login'); // Mengarahkan ke view bernama 'welcome'
    }
}