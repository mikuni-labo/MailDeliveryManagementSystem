<?php

namespace App\Models;

use App\Observers\DeliverySetVisitorObserver;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DeliverySetVisitor extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'mail_template_id',
        'delivery_set_id',
        'visitor_id',
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
        'id'               => 'integer',
        'mail_template_id' => 'integer',
        'delivery_set_id'  => 'integer',
        'visitor_id'       => 'integer',

    ];

    protected $perPage = 20;

    protected static function boot()
    {
        parent::boot();

        static::observe(DeliverySetVisitorObserver::class);
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
     * 配信セット毎来場者テーブルとのリレーションを定義
     *
     * @return BelongsTo
     */
    public function visitor() : BelongsTo
    {
        return $this->belongsTo(Visitor::class);
    }

}
