<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;
use Mockery\Generator\StringManipulation\Pass\Pass;
use Illuminate\Support\Facades\Log;

class HandlingResetLin extends Controller
{
    public function HandlingResetLink(Request $request)
    {
        try {
            Log::info('Received Token in Controller: ' . $request->input('token'));
            $status = Password::broker('admins')->reset(
                $request->only('email', 'password', 'token'),
                function (Admin $admin, string $password)use ($request) {
                    // Log before the closure for debugging
                    Log::info('Reached the closure');
            
                    // Log the admin data for debugging
                    Log::info('Admin Data: ', $admin->toArray());
            
                    // Log the admin ID for debugging
                    Log::info('Admin ID: ' . $admin->id);
            $hashedToken=Hash::make($request->token);
            Log::info('HahedToken'.$hashedToken);
                    $admin->forceFill([
                        'password' => Hash::make($password)
                    ]);
                    $admin->save();
                }
            );
            
            Log::info('Password Reset Status: ' . $status);
        
            if ($status == Password::PASSWORD_RESET) {
                return response()->json([
                    'Status' => $status,
                    'Message' => 'Password successfully updated'
                ]);
            } else {
                return response()->json([
                    'Status' => $status,
                    'Message' => 'Failed to reset NNN Password'
                ]);
            }
        } catch (\Exception $e) {
            Log::error('Exception during password reset: ' . $e->getMessage());
            return response()->json([
                'Status' => 'error',
                'Message' => 'An error occurred during password reset'
            ], 500);
        }
    }
    
}