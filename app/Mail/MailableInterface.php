<?php

namespace App\Mail;

Interface MailableInterface
{
    /**
     * Build the message.
     */
    public function build();
}
