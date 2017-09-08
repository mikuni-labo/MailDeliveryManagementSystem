<?php

namespace App\Http\Requests\Auth;

class ResetRequest extends AuthRequest
{
    /**
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @return boolean
     */
    public function authorize()
    {
        return true;
    }

    /**
     * @return array
     */
    public function rules()
    {
        return [
            'email'    => 'required|string|email|max:191|exists:users',
            'password' => 'required|string|min:6|max:16|confirmed',
        ];
    }

    /**
     * {@inheritDoc}
     * @see \Illuminate\Foundation\Http\FormRequest::messages()
     */
    public function messages()
    {
        return [
            //
        ];
    }

}
