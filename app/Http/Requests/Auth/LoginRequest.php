<?php

namespace App\Http\Requests\Auth;

class LoginRequest extends AuthRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'email'    => 'required|email|max:255',
            'password' => 'required|max:255',
            'remember' => 'boolean',
        ];
    }

    public function messages()
    {
        return [
            //
        ];
    }

}
