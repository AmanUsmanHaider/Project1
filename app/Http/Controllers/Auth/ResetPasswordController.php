<?php

namespace App\Http\Controllers\Auth;
use App\Models\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Mail\ResetPasswordMail; // Assuming you have a Mailable class
use App\Mail\TestEmail;

class ResetPasswordController extends Controller
{
    public function sendResetLinkEmail(Request $request)
    {

    
        // ...
        
        $request->validate([
            'email' => ['required', 'email'],
        ]);
        
        $status = Password::broker('admins')->sendResetLink(
            $request->only('email')
        );
        
     

    
        
        return response()->json([
            'status' => $status,
            'message' => $status == Password::RESET_LINK_SENT ? 'Password reset link sent' : 'Failed to send reset link',
        ]);
        
    }


  
}
