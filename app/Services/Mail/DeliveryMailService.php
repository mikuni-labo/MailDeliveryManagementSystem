<?php

namespace App\Services\Mail;

use App\Events\DeliveryMailLogEvent;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\PendingMail;

/**
 * メール配信サービス
 *
 * @author Kuniyasu Wada
 */
class DeliveryMailService
{
    private $mail;

    /**
     * Create a new class instance.
     *
     * @return void
     */
    public function __construct(PendingMail $mail)
    {
        $this->mail = $mail;
    }

    /**
     * @param Mailable $mailable
     * @return void
     */
    public function send(Mailable $mailable)
    {
        try {
            $this->mail->send($mailable);

            event(new DeliveryMailLogEvent($mailable));
        } catch (\Exception $e) {
            dd( $e->getMessage() );

//             event(new DeliveryMailLogEvent($mailable));
        }
    }

}
