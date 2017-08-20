<?php

namespace App\Http\Requests\Auth;

class RegisterRequest extends AuthRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name'                  => 'required|string|max:255',
            'email'                 => 'required|string|email|max:255|unique:users',
            'password'              => 'required|string|min:6|max:16|confirmed',
        ];
    }

    public function messages()
    {
        return [
            //
        ];
    }

}
