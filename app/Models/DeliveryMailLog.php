<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DeliveryMailLog extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'mail_template_id',
        'delivery_set_id',
        'from_name',
        'from_address',
        'subject',
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

    ];

    protected $perPage = 30;

    /**
     * Define relationship with other model.
     *
     * @return BelongsTo
     */
    public function deliveryMailLogVisitors() : HasMany
    {
        return $this->hasMany(DeliveryMailLogVisitor::class);
    }

    /**
     * Define relationship with other model.
     *
     * @return BelongsTo
     */
    public function mailTemplate() : BelongsTo
    {
        return $this->belongsTo(MailTemplate::class);
    }

    /**
     * Define relationship with other model.
     *
     * @return BelongsTo
     */
    public function deliverySet() : BelongsTo
    {
        return $this->belongsTo(DeliverySet::class);
    }

}
