<?php

namespace App\Models;

use App\Models\Visitor;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
        'data',
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
        'data'   => 'array',
//         'status' => 'boolean',

    ];

    protected $perPage = 20;

    /**
     * 属するテンプレートを定義
     *
     * @return BelongsTo
     */
    public function mailTemplate() : BelongsTo
    {
        return $this->belongsTo('App\Models\MailTemplate');
    }

    /**
     * 紐付く来場者を定義
     *
     * @return Builder
     */
    public function visitors() : Builder
    {
        return Visitor::whereIn('id', $this->data);
    }

}
