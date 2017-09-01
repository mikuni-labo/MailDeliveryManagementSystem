<?php

namespace App\Http\Requests\Mail\Set;

use App\Http\Requests\Request;

class DeliverySetRequest extends Request
{
    public function __construct()
    {
        parent::__construct();
    }

    public function attributes()
    {
        return [
            'name'     => '名称',
            'status'   => 'ステータス',
        ];
    }

}
