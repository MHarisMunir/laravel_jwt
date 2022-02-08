<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Bus\Dispatchable;


class WelcomeMail extends Mailable //implements ShouldQueue
{
    use Dispatchable, Queueable, SerializesModels;
    public $data;
    public $user;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {

        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        return $this->from(env('MAIL_USERNAME') , 'Muhammad Haris Munir')->subject('Email Verification')->view('emails.signup-email', ['data' => $this->data]);


    }


}
