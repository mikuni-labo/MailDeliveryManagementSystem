<?php

namespace App\Http\Requests\Auth;

class LoginRequest extends AuthRequest
{
    /**
     * @return boolean
     */
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'email'    => 'required|email|max:191',
            'password' => 'required|max:191',
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
