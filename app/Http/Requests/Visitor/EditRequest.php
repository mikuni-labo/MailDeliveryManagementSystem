<?php

namespace App\Http\Requests\Visitor;

use Illuminate\Validation\Rule;

class EditRequest extends VisitorRequest
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
        $id = request()->id;

        return [
            'name'                   => 'nullable|string|max:191',
            'organization'           => 'nullable|string|max:191',
            'department'             => 'nullable|string|max:191',
            'position'               => 'nullable|string|max:191',
            'postcode'               => 'nullable|numeric|digits_between:1,7',
            'email'                  => "required|string|email|max:191|unique:visitors,email,{$id},id",
            'address'                => 'nullable|string|max:65535',
            'tel'                    => 'nullable|numeric|digits_between:1,15',
            'fax'                    => 'nullable|numeric|digits_between:1,15',
//             'status'                 => 'required|boolean',
            'possible_delivery_flag' => 'required|boolean',
            'failed_delivery_flag'   => 'required|boolean',
            'exhibitor_type' => [
                'nullable',
                'numeric',
                'max:65535',
                Rule::in( array_flip($this->exhibitorType) ),
            ],
            'enterprise_type' => [
                'nullable',
                'numeric',
                'max:65535',
                Rule::in( array_flip($this->enterpriseType) ),
            ],
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
