<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\Request;

class AuthRequest extends Request
{
    public function __construct()
    {
        parent::__construct();
    }

    public function attributes()
    {
        return [
            'name'                  => 'ログイン名',
            'email'                 => 'メールアドレス',
            'password'              => 'パスワード',
            'password_confirmation' => 'パスワード(確認)',
        ];
    }

}
