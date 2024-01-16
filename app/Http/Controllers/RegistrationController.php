<?php

namespace App\Http\Controllers;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegistrationController extends Controller
{
    public function registerUser(Request $request)
    { 
        
        
        $request->validate([
        'name' => 'required',   
        'email' => 'required|string|email',
        'password' => 'required|string',
        'role' =>'required',
    ]);

  $user= Admin::create([
    'name' => $request->input('name'),
    'email' => $request->input('email'),
    'password' => Hash::make($request->input('password')),
    'role' => $request->input('role'),
   ]);

  

return response()->json([
    'User Info'=>$user,
    'Token'=>'User Register Successfully',

]);




    }
    public function login(Request $request)
    {
        $request->validate([
            
            'email' => 'required|string|email',
            'password' => 'required|string',
            'role' =>'required',

        ]);
     

      $admin=Admin::where('email',$request->email)->first();
      if($admin && Hash::check($request->password,$admin->password))
      {
        $token=$admin->createToken("Token created")->accessToken;
        return response()->json(['Info'=>'You Logged in suucessfully',
      'Token = '=>$token]);
      }
      return response()->json("Unauthorized",404);


    }

    
}
