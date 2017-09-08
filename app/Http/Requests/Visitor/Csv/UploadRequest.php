<?php

namespace App\Http\Requests\Visitor\Csv;

use App\Http\Requests\Request;

class UploadRequest extends Request
{
    /**
     * @return boolean
     */
    public function authorize()
    {
        return true;
    }

    /**
     * {@inheritDoc}
     * @see \Illuminate\Foundation\Http\FormRequest::attributes()
     */
    public function attributes()
    {
        return [
            'upload_csv' => '一括登録用CSV',
        ];
    }

    /**
     * @return array
     */
    public function rules()
    {
        return [
            "upload_csv"   => 'required|mime_csv|max:1024',// 1MB
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
