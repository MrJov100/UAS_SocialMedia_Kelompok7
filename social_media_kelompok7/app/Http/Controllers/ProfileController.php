<?php

namespace App\Http\Controllers;

use App\Models\Postingan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash; // P

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

    public function settings()
    {
        $user = Auth::user();
        return view('settings', compact('user'));
    }

    // Update username dan email
    public function updateUsernameEmail(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'username' => 'required|string|max:255|unique:users,username,' . $user->id,
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
        ]);

        $user->username = $request->username;
        $user->email = $request->email;
        $user->save();

        return redirect()->route('profile.show')->with('success', 'Username dan Email berhasil diperbarui.');
    }

    // Update password
    public function updatePassword(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'current_password' => 'required',
            'password' => 'required|string|min:8|confirmed',
        ], [
            'current_password.required' => 'Password lama harus diisi.',
            'password.required' => 'Password baru harus diisi.',
            'password.min' => 'Password baru minimal harus 8 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
        ]);

        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->back()->withErrors(['current_password' => 'Password lama tidak sesuai.']);
        }

        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('profile.show')->with('success', 'Password berhasil diperbarui.');
    }


    //ubah nama depan dan nama belakang
    public function updateName(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
        ]);

        // Update nama pengguna
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->save();

        return redirect()->route('profile.show')->with('success', 'Nama berhasil diperbarui.');
    }

}
