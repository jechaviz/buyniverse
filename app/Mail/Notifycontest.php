<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\EmailHelper;

class Notifycontest extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($job)
    {
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
        $subject = 'Contest is starting shortly'; 
        $header = EmailHelper::getEmailHeader();
        
        $footer = EmailHelper::getEmailFooter();
        return $this->view('emails.contestnotice')->with('job',$this->job)->with('header',$header)->with('footer',$footer)
        ->from($address, $name) 
        ->subject($subject);
    }
}
