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
            //Cek sudah pernah like atau belom
            $existingLike = Like::where('post_id', $id)->first();

            if(!$existingLike){
                $like = new Like (['post_id' => $id]);
                $post-> likes()->save($like);
                $post-> incrementLikesCount();
            } else {
                return response()->json(['Gagal' => false, 'message' => 'This post has already been liked'], 400);
            }

            return response()->json(['Berhasil' => true, 'count_likes' => $post->count_likes]);
        }
    }
}