<?php

namespace App\Services\Mail;

use App\Mail\MailableInterface;
use App\Models\Visitor;
use Illuminate\Support\Collection;
use Illuminate\Validation\Validator;

/**
 * メール配信サービス
 *
 * @author Kuniyasu Wada
 */
class DeliveryMailService
{
    /**
     * Create a new class instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * @param MailableInterface $mailable
     * @param Visitor $Visitor
     * @return void
     */
    public function send(MailableInterface $mailable, $target)
    {
        try {
            \Mail::to($target)
                ->send($mailable);
        } catch (\Exception $e) {

        }
    }

}
