<?php

namespace App\Http\Controllers;

use App\Models\Postingan;
use App\Models\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

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
                Log::info("User {$user->id} unliked post {$id}");
                $post->decrement('count_likes');
                $liked = false;
            } else {
                // Like the post
                Like::create([
                    'user_id' => $user->id,
                    'post_id' => $id,
                ]);
                $post->increment('count_likes');
                Log::info("User {$user->id} liked post {$id}");
                $liked = true;
            }

            return response()->json([
                'Berhasil' => true,
                'liked' => $liked,
                'count_likes' => $post->count_likes,
                'message' => $liked ? 'Post liked successfully.' : 'Post unliked successfully.'
            ]);
        }

        return response()->json(['Berhasil' => false, 'message' => 'Post not found.'], 404);
    }
}
