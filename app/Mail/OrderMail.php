<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderMail extends Mailable
{
    use Queueable, SerializesModels;

    public $order;

    public function __construct($order)
    {
        $this->order = $order;
    }
    
    public function build()
    {
        return $this->subject('Votre commande - ' . $this->order->adresse_livraison)
                    ->view('orderMail')  
                    ->with([
                        'order' => $this->order,
                    ]);
    }
}
