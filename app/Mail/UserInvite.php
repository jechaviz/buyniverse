<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\EmailHelper;

class UserInvite extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $job)
    {
        $this->user = $user;
        $this->job = $job;
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
        $subject = 'Team User Invitation'; 
        $header = EmailHelper::getEmailHeader();
        
        $footer = EmailHelper::getEmailFooter();
        return $this->view('emails.userinvite')->with('user',$this->user)->with('job',$this->job)->with('header',$header)->with('footer',$footer)
        ->from($address, $name) 
        ->subject($subject);
    }
}
