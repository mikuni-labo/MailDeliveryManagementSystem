<?php

namespace App\Listeners;

use App\Events\DeliveryMailEvent;
use App\Events\DeliveryMailLogEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\PendingMail;

class DeliveryMailEventListener implements ShouldQueue
{
    private $mail;

    /**
     * Create the event listener.
     *
     * @param PendingMail $mail
     * @return void
     */
    public function __construct(PendingMail $mail)
    {
        $this->mail = $mail;
    }

    /**
     * Handle the event.
     *
     * @param  DeliveryMailEvent  $event
     * @return void
     */
    public function handle(DeliveryMailEvent $event)
    {
        $message = "";

        try {
            $this->mail->send($event->mailable);

        } catch (\Exception $e) {
            $message = $e->getMessage();
        }

        event(new DeliveryMailLogEvent($event->mailable, $event->log, $message));
    }
}
