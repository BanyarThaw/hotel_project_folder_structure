<?php

namespace App\Mail;

use App\Models\Contact;
use App\Models\Contactreplies;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class replyMail extends Mailable
{
    use Queueable, SerializesModels;

    public $contact_mail;
    public $replymessage;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Contact $contact_mail,Contactreplies $replymessage)
    {
        $this->contact_mail = $contact_mail;
        $this->replymessage = $replymessage;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.replyMail');
    }
}
