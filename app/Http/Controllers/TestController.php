<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
class TestController extends Controller
{
    public function check()
    {
        $token = '$2y$12$.s99or.jbInJ9rk/JpmSFOxzn4GHaas720tPrCRPNBKlLPZjFEj92'; // Replace with your actual token
        $email = 'usmanlucky6227@gmail.com'; // Replace with the associated email
        $tokenExists = DB::table('password_reset_tokens')
        ->where('email', $email)
        ->where('token', $token)
        ->where('created_at', '>', now()->subMinutes(config('auth.passwords.admins.expire')))
        ->exists();
    
    if ($tokenExists) {
        // Token is valid
        dd('Token exists and is valid');
    } else {
        // Token does not exist or has expired
        dd('Token does not exist or has expired');
    }
    }
}
