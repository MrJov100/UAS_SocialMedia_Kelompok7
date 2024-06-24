<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Validator::extend('current_password', function ($attribute, $value, $parameters, $validator) {
            // Parameters[0] berisi nilai password saat ini yang harus divalidasi
            return Hash::check($value, $parameters[0]);
        });
    }

    public function register()
    {

    }
}