<?php

namespace App\Http\Requests\Auth;

class ModifyRequest extends AuthRequest
{
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
        $id = auth()->user()->id;

        return [
            'name'     => 'required|string|max:191',
            'email'    => "required|string|email|max:191|unique:users,email,{$id},id",
            'password' => 'nullable|string|min:6|max:16|confirmed',
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
