<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class InviteRaw extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($messagex)
    {
        $this->messagex = $messagex;
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
        $subject = 'Job Invitation'; 
        return $this->view('emails.inviteraw')->with('messagex',$this->messagex)
        ->from($address, $name) 
        ->subject($subject);
    }
}
