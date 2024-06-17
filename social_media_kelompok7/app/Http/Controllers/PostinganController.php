<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Postingan;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;


class PostinganController extends Controller
{
    public function index()
    {
        $postingans = Postingan::latest()->get();
        return view('beranda', compact('postingans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'caption' => 'required|string|max:255',
        ]);

        $fotoName = time().'.'.$request->foto->extension();  
        $request->foto->move(public_path('foto'), $fotoName);

        Postingan::create([
            'user_id' => Auth::id(),  // Simpan ID pengguna yang membuat postingan
            'foto' => $fotoName,
            'caption' => $request->caption,
        ]);

        return redirect()->back()->with('success', 'Postingan berhasil ditambahkan.');
    }

    public function destroy($id)
    {
        $postingan = Postingan::findOrFail($id);
        
        // Hapus file foto dari direktori
        $filePath = public_path('foto/'.$postingan->foto);
        if (File::exists($filePath)) {
            File::delete($filePath);
        }

        // Hapus data postingan dari database
        $postingan->delete();

        return redirect()->back()->with('success', 'Postingan berhasil dihapus.');
        
    }
}
