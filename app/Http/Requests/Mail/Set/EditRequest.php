<?php

namespace App\Http\Requests\Mail\Set;

class EditRequest extends DeliverySetRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'mail_template_id' => 'required|exists:mail_templates,id',
            'name'             => 'required|string|max:191',
            'status'           => 'required|boolean',
        ];
    }

    public function messages()
    {
        return [
            //
        ];
    }

}
