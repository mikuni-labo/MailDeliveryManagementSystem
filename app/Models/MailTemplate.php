<?php

namespace App\Models;

use App\Observers\MailTemplateObserver;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MailTemplate extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'subject',
        'content',
        'from',
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
        'from'   => 'integer',

    ];

    protected $perPage = 20;

    protected static function boot()
    {
        parent::boot();

        static::observe(MailTemplateObserver::class);
    }

    /**
     * Define relationship with other model.
     *
     * @return HasMany
     */
    public function deliverySets() : HasMany
    {
        return $this->hasMany(DeliverySet::class);
    }

    /**
     * Define relationship with other model.
     *
     * @return HasMany
     */
    public function deliverySetVisitors() : HasMany
    {
        return $this->hasMany(DeliverySetVisitor::class);
    }

    /**
     * Define relationship with other model.
     *
     * @return HasMany
     */
    public function deliveryMailLogs() : HasMany
    {
        return $this->hasMany(DeliveryMailLog::class);
    }

}
