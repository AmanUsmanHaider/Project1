<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
 
    public function login(Request $request)
    {
        $request->validate([
         
            'email' => 'required|string|email',
            'password' => 'required|string',
         
        ]);
        $useremail=$request->input('email');
        $userpassword=$request->input('password');

        $user=Admin::where(['email'=>$useremail])->first();

if($user && Hash::check($userpassword,$user->password))
{
    $token=$user->createToken('Yes gOT tOKEN')->accessToken;
   return response()->json([
    'UserLogin='=>$user,
    'Message '=>'User Successfully Registered Found',
    'Token'=>$token,
]);
}
else
{
    
    return response()->json([
       
        'Message'=>'User nOT fOUND'
    ]);


}




    }
   
}
