<?php

namespace App\Http\Requests\Mail;

class StoreRequest extends MailRequest
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
        return [
            'subject'  => 'required|string|max:191',
            'from'     => 'required|numeric|min:1|max:191',
            'content'  => 'required|string|min:1|max:65535',
//             'status'   => 'required|boolean',
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
