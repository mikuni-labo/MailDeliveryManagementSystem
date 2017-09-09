<?php

namespace App\Http\Requests\Visitor;

use App\Http\Requests\Request;

class VisitorRequest extends Request
{
    /**
     * @var array
     */
    protected $exhibitorType;

    /**
     * @var array
     */
    protected $enterpriseType;

    /**
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

        $this->exhibitorType = config('fixture.visitor.exhibitor_type');
        array_unshift($this->exhibitorType, '');

        $this->enterpriseType = config('fixture.visitor.enterprise_type');
        array_unshift($this->enterpriseType, '');
    }

    /**
     *
     * {@inheritDoc}
     * @see \Illuminate\Foundation\Http\FormRequest::attributes()
     */
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
//             'status'        => 'ステータス',
            'possible_delivery_flag' => '配信可否フラグ',
            'failed_delivery_flag'   => '送信エラーフラグ',
            'exhibitor_type'         => '出展者タイプ',
            'enterprise_type'        => '企業タイプ',
        ];
    }

}
