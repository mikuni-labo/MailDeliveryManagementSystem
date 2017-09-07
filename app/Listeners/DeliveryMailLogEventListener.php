<?php

namespace App\Listeners;

use App\Events\DeliveryMailLogEvent;
use App\Models\DeliveryMailLogVisitor;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class DeliveryMailLogEventListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  DeliveryMailLogEvent  $event
     * @return void
     */
    public function handle(DeliveryMailLogEvent $event)
    {
        DeliveryMailLogVisitor::create([
            'delivery_mail_log_id' => $event->log->id,
            'to'                   => $event->mailable->getVisitor()->email,
            'content'              => $event->mailable->viewData['content'],
            'result'               => empty($event->message) ? true : false,
            'message'              => $event->message,
        ]);
    }

}
