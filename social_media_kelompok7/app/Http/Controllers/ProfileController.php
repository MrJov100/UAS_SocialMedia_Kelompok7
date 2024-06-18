<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        return view('profile', compact('user'));
    }
    public function updateProfilePicture(Request $request)
{
    $request->validate([
        'profile_picture' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:10240',
    ]);

    $user = auth()->user();
    if ($request->hasFile('profile_picture')) {
        $file = $request->file('profile_picture');
        $path = $file->store('profile_pictures', 'public');

        // Delete the old profile picture if exists
        if ($user->profile_picture) {
            Storage::disk('public')->delete($user->profile_picture);
        }

        // Save new profile picture path
        $user->profile_picture = $path;
        $user->save();
    }

    return back()->with('success', 'Profile picture updated successfully.');
}
}

