<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Postingan;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    //
    public function store(Request $request, $postId)
    {
        $post = Postingan::where('id', $postId)->first();
        if (!$post) {
            return redirect()->back()->with('error', 'Post tidak ditemukan.');
        }

        $post->comments()->create([
            'user_id' => auth()->id(),
            'comment' => $request->comment,
        ]);

        return redirect()->back()->with('success', 'Komentar berhasil ditambahkan.');
    }


    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);
        $comment->delete();
        return back()->with('success', 'Komentar berhasil dihapus.');
    }

    // Update comment
    public function update(Request $request, $id)
    {
        $comment = Comment::findOrFail($id);
        $comment->comment = $request->input('comment');
        $comment->save();
        return back()->with('success', 'Komentar berhasil diperbarui.');
    }
}
