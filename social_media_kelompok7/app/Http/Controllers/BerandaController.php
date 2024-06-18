<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Foto; // assume you have a Foto model

class BerandaController extends Controller
{
    public function index() {
        $postingan = Postingan::with('user')->get();
        return view('beranda', ['postingan' => $postingan]);
    }
    
}