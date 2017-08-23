<?php

namespace App\Http\Requests\Mail;

class StoreRequest extends MailRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
//             'email'    => 'required|email|max:255',
        ];
    }

    public function messages()
    {
        return [
            //
        ];
    }

}
