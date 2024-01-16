<?php

use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\CrudController;
use App\Http\Controllers\HandlingResetLin;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\SendEmail;
use Illuminate\Auth\Events\Login;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Password;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::middleware('auth:admins')->group(function () {
    // Your admin routes go here
  
});
Route::post('/passwordemail',[ResetPasswordController::class,'sendResetLinkEmail']);
Route::post('/resetPassword',[HandlingResetLin::class,'HandlingResetLink']);
Route::post('/insert',[RegistrationController::class,'registerUser']);
Route::post('/login',[LoginController::class,'login']);

Route::get('sendemail',[SendEmail::class,'sendTestEmail']);
// In a route or controller
Route::get('/env', function () {
    return response()->json([
        'MAIL_PORT' => env('MAIL_PORT'),
    ]
    );

});
Route::post('/forgot-password', function (Request $request) {
    $request->validate(['email' => 'required|email']);
 
    $status = Password::sendResetLink(
        $request->only('email')
    );
 
    return $status === Password::RESET_LINK_SENT
                ? back()->with(['status' => __($status)])
                : back()->withErrors(['email' => __($status)]);
});

Route::middleware('auth:api')->group(function ()
{ 
     Route::get('/getuser',[CrudController::class,'getUser']);
     Route::get('/logout',[CrudController::class,'logout']);


});
