<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use App\Events\OrderPlacedEvent;
use App\Listeners\SendPlaceOrderNotificationListener;


class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        OrderPlacedEvent::class => [
            SendPlaceOrderNotificationListener::class,
        ],
    ];

    public function boot()
    {
        //
    }
}
