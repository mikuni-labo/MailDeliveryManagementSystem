<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

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

    /**
     * テンプレートとのリレーションを定義
     *
     * @return BelongsTo
     */
    public function mailTemplate() : BelongsTo
    {
        return $this->belongsTo('App\Models\MailTemplate');
    }

    /**
     * 配信セットとのリレーションを定義
     *
     * @return BelongsTo
     */
    public function deliverySet() : BelongsTo
    {
        return $this->belongsTo('App\Models\DeliverySet');
    }

    /**
     * 来場者とのリレーションを定義
     *
     * @return BelongsTo
     */
    public function visitor() : BelongsTo
    {
        return $this->belongsTo('App\Models\Visitor');
    }

    /**
     * 条件に沿ったレコードを返す
     *
     * @param integer|null $templateId
     * @param integer|null $setId
     * @param integer|null $visitorId
     * @return Builder
     */
    public static function exists($templateId = null, $setId = null, $visitorId = null) : Builder
    {
        $query = self::query();

        if( is_numeric($templateId) ) {
            $query->where('mail_template_id', '=', $templateId);
        }

        if( is_numeric($setId) ) {
            $query->where('delivery_set_id', '=', $setId);
        }

        if( is_numeric($visitorId) ) {
            $query->where('visitor_id', '=', $visitorId);
        }

        return $query;
    }

}