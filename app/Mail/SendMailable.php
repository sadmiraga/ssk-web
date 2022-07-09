<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendMailable extends Mailable
{
    use Queueable, SerializesModels;
    public $invitationMessage;
    public $eventName;
    public $eventImage;
    public $subject;


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($message, $eventName, $eventImage, $subject)
    {
        $this->invitationMessage = $message;
        $this->eventName = $eventName;
        $this->eventImage = $eventImage;
        $this->subject = $subject;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        //return $this->view('emails.invitation');

        return $this->from('info@ssk.si')
            ->subject($this->subject)
            ->view('emails.invitation');
    }
}
