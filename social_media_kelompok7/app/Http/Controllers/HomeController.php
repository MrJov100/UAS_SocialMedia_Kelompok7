<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Foto; // assume you have a Foto model

class HomeController extends Controller
{
    public function index()
    {
        return view('homepage'); // Mengarahkan ke view bernama 'welcome'
    }
}

class FotoController extends Controller
{
    public function uploadFoto(Request $request)
    {
        // kode untuk mengupload foto ke server
        $foto = $request->file('foto');
        $caption = $request->input('caption');
        //...
        return redirect()->back()->with('success', 'Foto berhasil diupload!');
    }
}

