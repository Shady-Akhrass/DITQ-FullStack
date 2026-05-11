<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactMail extends Mailable
{
    use Queueable, SerializesModels;
    public $contact_data;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($contact_data)
    {
        $this->contact_data = $contact_data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('no_reply@gmail.com')->subject('Contact Message')->view('frontsite.Contact-Us');
    }
}
