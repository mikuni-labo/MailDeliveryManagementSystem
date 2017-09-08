<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DeliverySet extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'mail_template_id',
        'name',
//         'status',
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
        'id'     => 'integer',
//         'status' => 'boolean',

    ];

    protected $perPage = 20;

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
     * 配信セット毎来場者テーブルとのリレーションを定義
     *
     * @return HasMany
     */
    public function deliverySetVisitors() : HasMany
    {
        return $this->hasMany(DeliverySetVisitor::class);
    }

    /**
     * メール配信ログテーブルとのリレーションを定義
     *
     * @return HasMany
     */
    public function deliveryMailLogs() : HasMany
    {
        return $this->hasMany(DeliveryMailLog::class);
    }

}
