<?php

namespace App\Services\Mail;

use App\Models\Visitor;
use Illuminate\Mail\Mailable;

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
     * @param Mailable $mailable
     * @param Visitor $Visitor
     * @return void
     */
    public function send(Mailable $mailable, $target)
    {
        try {
            \Mail::to($target)->send($mailable);
        } catch (\Exception $e) {
            dd( $e->getMessage() );
        }
    }

}
