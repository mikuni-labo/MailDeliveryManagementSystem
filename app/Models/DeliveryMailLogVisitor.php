<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DeliveryMailLogVisitor extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'delivery_mail_log_id',
        'to',
        'content',
        'result',
        'message',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        //
    ];

    /**
     * The attributes for cast to Carbon.
     *
     * @var array
     */
    protected $dates = [
        //
    ];

    /**
     * The attributes for casts.
     *
     * @var array
     */
    protected $casts = [
        'id'                   => 'integer',
        'delivery_mail_log_id' => 'integer',
        'result'               => 'boolean',

    ];

    protected $perPage = 20;

    /**
     * メール配信ログテーブルとのリレーションを定義
     *
     * @return BelongsTo
     */
    public function deliveryMailLog() : BelongsTo
    {
        return $this->belongsTo(deliveryMailLog::class);
    }

    /**
     * テンプレートテーブルとのリレーションを定義
     *
     * @return BelongsTo
     */
    public function mailTemplate() : BelongsTo
    {
        return $this->belongsTo(MailTemplate::class);
    }

    /**
     * 配信セットテーブルとのリレーションを定義
     *
     * @return BelongsTo
     */
    public function deliverySet() : BelongsTo
    {
        return $this->belongsTo(DeliverySet::class);
    }

    /**
     * 来場者テーブルとのリレーションを定義
     * （保有メールアドレス）
     *
     * @return BelongsTo
     */
    public function visitor() : BelongsTo
    {
        return $this->belongsTo(Visitor::class, 'to', 'email');
    }

}
