<?php

namespace App\Http\Requests\Mail;

use App\Http\Requests\Request;

class MailRequest extends Request
{
    /**
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * {@inheritDoc}
     * @see \Illuminate\Foundation\Http\FormRequest::attributes()
     */
    public function attributes()
    {
        return [
            'subject'  => '題名',
            'from'     => '差出人',
            'content'  => '本文',
        ];
    }

}
