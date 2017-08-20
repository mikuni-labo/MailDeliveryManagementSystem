<?php

namespace App\Http\Requests\Auth;

class ResendRequest extends AuthRequest
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
            'email' => 'required|email|exists:users|max:255',
        ];
    }

    public function messages()
    {
        return [
            //
        ];
    }

}
