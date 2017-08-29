<?php

namespace App\Http\Requests\Visitor\Csv;

use App\Http\Requests\Request;

class UploadRequest extends Request
{
    public function authorize()
    {
        return true;
    }

    public function attributes()
    {
        return [
            'upload_csv' => '一括登録用CSV',
        ];
    }

    public function rules()
    {
        return [
            "upload_csv"   => 'required|mime_csv|max:1024',// 1MB
        ];
    }

    public function messages()
    {
        return [
            //
        ];
    }

}
