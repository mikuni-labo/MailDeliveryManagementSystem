<?php

namespace App\Http\Requests\Auth;

class ModifyRequest extends AuthRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $id = auth()->user()->id;

        return [
            'name'     => 'required|string|max:191',
            'email'    => "required|string|email|max:191|unique:users,email,{$id},id",
            'password' => 'nullable|string|min:6|max:16|confirmed',
        ];
    }

    public function messages()
    {
        return [
            //
        ];
    }

}
