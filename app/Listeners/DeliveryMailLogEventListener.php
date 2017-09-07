<?php

namespace App\Listeners;

use App\Events\DeliveryMailLogEvent;
use App\Models\DeliveryMailLog;
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
        DeliveryMailLog::create([
            'mail_template_id' => $event->mailable->getMailTemplate()->id,
            'delivery_set_id'  => $event->mailable->getDeliverySet()->id,
            'result'           => true,// TODO 要調整
            'to'               => $event->mailable->getVisitor()->email,
            'from'             => $this->buildFrom($event->mailable->from),// TODO 要調整
            'subject'          => $event->mailable->subject,
            'content'          => $event->mailable->viewData['content'],
            'message'          => "test",// TODO 要調整
        ]);
    }

    /**
     * @param array $from
     * @return string
     */
    private function buildFrom(array $from)
    {
        return "{$from[0]['name']} <{$from[0]['address']}>";
    }

}
