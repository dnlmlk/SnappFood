<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderMail extends Mailable
{
    use Queueable, SerializesModels;

    public $order;
    public $user;
    public $restaurant;
    /**
     * Create a new message instance.
     *
     * @return void
     */

    public function __construct($order)
    {
        $this->order = $order;
        $this->user = $order->user;
        $this->restaurant = $order->restaurant;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.order')->
            subject('Your order has entered to a new stage')->
            to($this->user->email);
    }
}
