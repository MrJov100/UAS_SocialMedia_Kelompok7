<?php

namespace App\Http\Controllers;

use App\Models\Postingan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        $postingans = Postingan::where('user_id', $user->id)->latest()->get();
        return view('profile', compact('user', 'postingans'));
    }
    public function updateProfilePicture(Request $request)
{
    $request->validate([
        'profile_picture' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:10240'//max upload file 10 MB
    ]);

    $user = auth()->user();
    if ($request->hasFile('profile_picture')) {
        $file = $request->file('profile_picture');
        $path = $file->store('profile_pictures', 'public');

        //menghapus foto profile lama mengganti dengan yang baru 
        if ($user->profile_picture) {
            Storage::disk('public')->delete($user->profile_picture);
        }

        // Save profile baru
        $user->profile_picture = $path;
        $user->save();
    }

    return back()->with('success', 'Profile picture updated successfully.');
}
}

