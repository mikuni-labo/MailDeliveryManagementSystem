<?php

namespace App\Http\Requests\Mail;

class EditRequest extends MailRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'subject'  => 'required|string|max:255',
//             'from'     => 'required|numeric|min:1|max:255',
            'content'  => 'required|string|min:1|max:65535',
        ];
    }

    public function messages()
    {
        return [
            //
        ];
    }

}
