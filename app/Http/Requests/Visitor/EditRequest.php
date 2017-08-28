<?php

namespace App\Http\Requests\Visitor;

class EditRequest extends VisitorRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $id = request()->id;

        return [
            'name'          => 'nullable|string|max:255',
            'organization'  => 'nullable|string|max:255',
            'department'    => 'nullable|string|max:255',
            'position'      => 'nullable|string|max:255',
            'postcode'      => 'nullable|numeric|digits_between:1,7',
            'email'         => "required|string|email|max:255|unique:visitors,email,{$id},id",
            'address'       => 'nullable|string|max:65535',
            'tel'           => 'nullable|numeric|digits_between:1,15',
            'fax'           => 'nullable|numeric|digits_between:1,15',
        ];
    }

    public function messages()
    {
        return [
            //
        ];
    }

}
