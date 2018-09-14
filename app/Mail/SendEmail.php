<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendEmail extends Mailable
{
    use Queueable, SerializesModels;
    public $message;
    
    public function __construct($message)
    {
       $this->message = $message;
    }

   
    // public function build()
    // {
    //     return $this->view('email.email');
    // }
   
}
