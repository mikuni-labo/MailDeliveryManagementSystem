<?php

namespace App\Http\Requests\Auth;

class ResetRequest extends AuthRequest
{
    public function __construct()
    {
        parent::__construct();
    }

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'email'    => 'required|string|email|max:255|exists:users',
            'password' => 'required|string|min:6|max:16|confirmed',
        ];
    }

    public function messages()
    {
        return [
            //
        ];
    }

}
