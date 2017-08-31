<?php

namespace App\Http\Requests\Visitor;

use App\Http\Requests\Request;

class VisitorRequest extends Request
{
    public function __construct()
    {
        parent::__construct();
    }

    public function attributes()
    {
        return [
            'name'          => '氏名',
            'organization'  => '組織名',
            'department'    => '部署名',
            'position'      => '役職',
            'postcode'      => '郵便番号',
            'email'         => 'メールアドレス',
            'address'       => '住所',
            'tel'           => 'TEL',
            'fax'           => 'FAX',
            'status'        => 'ステータス',
            'possible_delivery_flag' => '配信可否フラグ',
            'exhibitor_type'         => '出展者タイプ',
            'enterprise_type'        => '企業タイプ',
        ];
    }

}
