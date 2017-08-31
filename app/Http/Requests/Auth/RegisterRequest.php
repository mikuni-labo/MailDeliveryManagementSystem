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
            'name'     => 'required|string|max:191',
            'email'    => 'required|string|email|max:191|unique:users',
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
