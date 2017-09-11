<?php

namespace App\Http\Requests\Mail\Set;

class EditRequest extends DeliverySetRequest
{
    /**
     * @return boolean
     */
    public function authorize() : bool
    {
        return true;
    }

    /**
     * @return array
     */
    public function rules() : array
    {
        return [
            'mail_template_id' => 'required|exists:mail_templates,id',
            'name'             => 'required|string|max:191',
        ];
    }

    /**
     * {@inheritDoc}
     * @see \Illuminate\Foundation\Http\FormRequest::messages()
     */
    public function messages() : array
    {
        return [
            //
        ];
    }

}
