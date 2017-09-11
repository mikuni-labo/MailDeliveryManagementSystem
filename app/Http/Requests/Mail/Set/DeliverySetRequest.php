<?php

namespace App\Http\Requests\Mail\Set;

use App\Http\Requests\Request;

class DeliverySetRequest extends Request
{
    /**
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * {@inheritDoc}
     * @see \Illuminate\Foundation\Http\FormRequest::attributes()
     */
    public function attributes() : array
    {
        return [
            'name'     => '名称',
        ];
    }

}
