<?php

namespace App\Models;

use App\Traits\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Http\Request;

class DeliveryMailLog extends Model
{
    use Scope;

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

    /**
     * Search
     *
     * @param Request $request
     * @return Builder
     */
    public static function search(Request $request) : Builder
    {
        /**
         * @var Builder $query
         */
        $query = self::query();

        $query->select([
            'delivery_mail_logs.*',
        ]);

        $query->leftJoin('delivery_mail_log_visitors', function($join) {
            $join->on('delivery_mail_logs.id', '=', 'delivery_mail_log_visitors.delivery_mail_log_id');
        });

        $query->when($request->has('templateId'), function($query) use ($request) {
            $query->templateId($request->get('templateId'), 'delivery_mail_logs.mail_template_id');
        });

        $query->when($request->has('setId'), function($query) use ($request) {
            $query->setId($request->get('setId'), 'delivery_mail_logs.delivery_set_id');
        });

        $query->when($request->has('visitorId'), function($query) use ($request) {
            $query->visitorId($request->get('visitorId'), 'delivery_mail_log_visitors.visitor_id');
        });

        $query->distinct();
        $query->latest();

        return $query;
    }

}
