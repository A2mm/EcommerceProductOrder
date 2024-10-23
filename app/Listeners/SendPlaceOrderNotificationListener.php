<?php

namespace App\Listeners;

use App\Mail\OrderNotificationMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendPlaceOrderNotificationListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        Mail::to(env('MAIL_TO_ADDRESS'))->send(new OrderNotificationMail($event->order));
    }
}
