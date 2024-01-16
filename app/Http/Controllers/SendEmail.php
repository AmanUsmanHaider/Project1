<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\TestEmail;

class SendEmail extends Controller
{
    public function sendTestEmail()
    {
        // Replace 'recipient@example.com' with the actual recipient email address
        Mail::to('usama4007105@gmail.com')->send(new TestEmail());

        return response()->json("Message Sent Successfully");
    }
}
