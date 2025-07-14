<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $emailPacket;

    public function __construct($emailPacket)
    {
        $this->emailPacket = $emailPacket;
    }

    public function build()
    {
        $email = $this->subject($this->emailPacket['subject']);
        if (!empty($this->emailPacket['cc_email'])) {
            $email->cc($this->emailPacket['cc_email']);
        }
        return $email->html($this->emailPacket['body']);
    }
}
