<?php

namespace Plugins\Contact\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReplayContactMessage extends Mailable
{
    use Queueable, SerializesModels;

    public $contact;
    public $message;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($contact, $message)
    {
        $this->contact = $contact;
        $this->message= $message;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this ->subject("Re " .$this->contact->subject)
            ->markdown('contact::mail.replay_message', [
            'contact' => $this->contact,
            'message' => (string)$this->message,
        ]);
    }
}
