<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\WelcomeMail;
use Illuminate\Support\Facades\Mail;
//use Illuminate\Mail\Mailable;
//use Illuminate\Contracts\Mail\Mailable;

use App\Jobs\WelcomeMailJob;

class MailController extends Controller
{
    public static function sendSignupEmail($name, $email, $verification_code){
        $data = [
            'name' => $name,
            'email' => $email,
            'verification_code' => $verification_code
        ];
        Mail::to($email)->send(new WelcomeMail($data));  //using mailer class
    }
}
