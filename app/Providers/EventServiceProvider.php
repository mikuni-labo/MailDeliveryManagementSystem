<?php

namespace App\Providers;

use App\Events\Delivery\DeliveryMailEvent;
use App\Events\Delivery\DeliveryMailLogEvent;
use App\Listeners\Delivery\DeliveryMailEventListener;
use App\Listeners\Delivery\DeliveryMailLogEventListener;
use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        /**
         * DeliveryMail
         */
        DeliveryMailEvent::class => [
            DeliveryMailEventListener::class,
        ],
        /**
         * DeliveryMailLog
         */
        DeliveryMailLogEvent::class => [
            DeliveryMailLogEventListener::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
