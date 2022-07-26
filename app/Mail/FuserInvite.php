<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class FuserInvite extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $address = 'noreply@Buyniverse.com'; 
        $name = 'Buyniverse'; 
        $subject = 'Provider Team Invitation'; 
        $header = EmailHelper::getEmailHeader();
        
        $footer = EmailHelper::getEmailFooter();
        return $this->view('emails.fuserinvite')->with('user',$user)->with('header',$header)->with('footer',$footer)
        ->from($address, $name) 
        ->subject($subject);
    }
}
