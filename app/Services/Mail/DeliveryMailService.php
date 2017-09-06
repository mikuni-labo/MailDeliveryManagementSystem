<?php

namespace App\Services\Mail;

use App\Models\Visitor;
use App\Services\Mail\MailServiceInterface;
use Illuminate\Support\Collection;
use Illuminate\Validation\Validator;

/**
 * メール配信サービス
 *
 * @author Kuniyasu Wada
 */
class DeliveryMailService implements MailServiceInterface
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
     *
     * {@inheritDoc}
     * @see \App\Services\Mail\MailServiceInterface::send()
     */
    public function send()
    {
        //
    }

}
