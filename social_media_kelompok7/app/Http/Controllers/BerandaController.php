<?php

namespace App\Http\Controllers;

use App\Models\Postingan;

class BerandaController extends Controller
{
    public function index() {
        $postingan = Postingan::with('user')->get(); // Ensure to load the user relationship
        return view('beranda', ['postingan' => $postingan, 'currentUser' => auth()->user()]);
    }

    public function likePost(Request $request, $id)
    {
        $post = Postingan::find($id);
        if($post){
            $post->count_likes += 1;
            $post->save();
            return response()->json(['Berhasil' => true, 'count_likes' => $post->count_likes]);
        }
        return response()->json(['Gagal' => false, 'message' => 'Gambar tidak ditemukan'], 404);
    }
}