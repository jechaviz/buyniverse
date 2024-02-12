<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\EmailHelper;

class InviteProvider extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($employer, $slug)
    {
        
        $this->employer = $employer;
        $this->slug = $slug;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        //return $this->view('view.name');
        $address = 'noreply@Buyniverse.com'; 
        $name = 'Buyniverse'; 
        $subject = 'Job Invitation'; 
        $header = EmailHelper::getEmailHeader();
        
        $footer = EmailHelper::getEmailFooter();
        return $this->view('emails.invite')->with('employer',$this->employer)->with('slug',$this->slug)->with('header',$header)->with('footer',$footer)
        ->from($address, $name) 
        ->subject($subject);
    }
}
