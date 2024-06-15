<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class SignupController extends Controller
{
    public function showRegistrationForm()
    {
        return view('signup');  // points to resources/views/signup.blade.php
    }

    public function register(Request $request)
    {
        // Validate the incoming request data
        $validator = $this->validator($request->all());

        // If validation fails, redirect back with errors
        if ($validator->fails()) {
            return redirect('/signup')
                        ->withErrors($validator)
                        ->withInput();
        }

        // If validation passes, create the user
        $user = $this->create($request->all());

        // Redirect the user after successful registration
        return redirect('/')->with('success', 'Account created successfully!');
    }

    protected function validator(array $data)
{
    return Validator::make($data, [
        'first_name' => ['required', 'string', 'max:255'],
        'last_name' => ['required', 'string', 'max:255'],
        'username' => ['required', 'string', 'max:255', 'unique:users'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'password' => ['required', 'string', 'min:8', 'confirmed'],
        'dob' => ['required', 'date'],
        'gender' => ['required', 'string'],
    ], [
        'password.confirmed' => 'The password confirmation does not match.'
    ]);
}

    protected function create(array $data)
    {
        return User::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'dob' => $data['dob'],
            'gender' => $data['gender'],
        ]);
    }
}