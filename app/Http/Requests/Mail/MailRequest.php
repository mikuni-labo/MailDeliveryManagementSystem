<?php

namespace App\Http\Requests\Mail;

use App\Http\Requests\Request;

class MailRequest extends Request
{
    public function __construct()
    {
        parent::__construct();
    }

    public function attributes()
    {
        return [
//             'name'                  => 'ログイン名',
        ];
    }

}
