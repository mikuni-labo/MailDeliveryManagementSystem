<?php

namespace App\Services\Mail;

use App\Models\Visitor;
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

            /**
             * TODO ログイベント
             */

        } catch (\Exception $e) {
            /**
             * TODO ログイベント
             */

            dd( $e->getMessage() );
        }
    }

}
