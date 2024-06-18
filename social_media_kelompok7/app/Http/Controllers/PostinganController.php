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
    $post = Postingan::find($id);

    // Check if the authenticated user is the owner of the post
    if (Auth::check() && Auth::id() == $post->user_id) {
        $post->delete();
        return redirect()->back()->with('success', 'Post deleted successfully.');
    } else {
        return redirect()->back()->with('error', 'You do not have permission to delete this post.');
    }
}

public function update(Request $request, $id)
    {
        $postingan = Postingan::find($id);

        if (auth()->user()->id !== $postingan->user_id) {
            return redirect()->back()->with('error', 'Unauthorized action.');
        }

        $request->validate([
            'caption' => 'required|max:255',
        ]);

        $postingan->caption = $request->caption;
        $postingan->save();

        return redirect()->back()->with('success', 'Caption updated successfully.');
    }


}
