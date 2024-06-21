<?php

namespace App\Http\Controllers;

use app\Models\Postingan;
use App\Models\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function likePost(Request $request, $id)
    {
        $post = Postingan::find($id);
        if ($post) {
            $user = Auth::user();

            // Check if the user already liked the post
            $existingLike = Like::where('post_id', $id)->where('user_id', $user->id)->first();

            if ($existingLike) {
                // Unlike the post
                $existingLike->delete();
                $post->decrement('count_likes');
                $liked = false;
            } else {
                // Like the post
                $like = new Like(['post_id' => $id, 'user_id' => $user->id]);
                $like->save();
                $post->increment('count_likes');
                $liked = true;
            }

            return response()->json(['Berhasil' => true, 'count_likes' => $post->count_likes, 'liked' => $liked]);
        }
        return response()->json(['Gagal' => false, 'message' => 'Gambar tidak ditemukan'], 404);
    }
}
