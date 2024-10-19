<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RegistrationConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    public $event;

    public function __construct($event)
    {
        $this->event = $event;
    }

    public function build()
    {
        return $this->subject('Confirmation d\'inscription à l\'événement: ' . $this->event->title)
        ->view('registration_confirmation') // Make sure this matches the view file name
        ->with(['event' => $this->event]); 
    }
}
