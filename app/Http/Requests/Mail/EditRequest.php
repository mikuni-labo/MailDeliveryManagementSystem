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
            'subject'  => 'required|string|max:191',
            'from'     => 'required|numeric|min:1|max:191',
            'content'  => 'required|string|min:1|max:65535',
            'status'   => 'required|boolean',
        ];
    }

    public function messages()
    {
        return [
            //
        ];
    }

}
