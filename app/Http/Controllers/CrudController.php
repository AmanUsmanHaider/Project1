<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Passport\TokenRepository;

class CrudController extends Controller
{
    public function login()
    {


$authnticateduser=auth()->user();


if( is_null($authnticateduser))
{
return response()->json("No User Found");

}

else
{
    
    return response()->json([
        'UserInfo'=>$authnticateduser,
        'Message'=>'Successfully Login',
        'Status'=>1,

    ]);
   
}



    }

public function getUser(Request $request)
{

    $user = Auth::user();

    return response()->json(['user' => $user]);


}

public function logout(Request $request,TokenRepository $tokenRepository)
{

$user=$request->user();
$tokenRepository->revokeAccessToken($user->token()->id);
return response()->json([
    'User Info'=>$user,
    'Message'=>'User Logout Successfully',
]);



}


}


