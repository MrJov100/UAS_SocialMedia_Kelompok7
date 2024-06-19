<?php

namespace App\Http\Controllers;

use App\Models\Postingan;

class BerandaController extends Controller
{
    public function index() {
        $postingan = Postingan::with('user')->get(); // Ensure to load the user relationship
        return view('beranda', ['postingan' => $postingan, 'currentUser' => auth()->user()]);
    }
}