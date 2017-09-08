<?php

namespace App\Models;

use App\Observers\VisitorObserver;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;

class Visitor extends Model
{
    use Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'organization',
        'department',
        'position',
        'postcode',
        'address',
        'email',
        'tel',
        'fax',
//         'status',
        'possible_delivery_flag',
        'exhibitor_type',
        'enterprise_type',
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
//         'status' => 'bool',
    ];

    /**
     * The attributes for casts.
     *
     * @var array
     */
    protected $casts = [
        'id'                     => 'integer',
//         'status'                 => 'boolean',
        'possible_delivery_flag' => 'boolean',
        'exhibitor_type'         => 'integer',
        'enterprise_type'        => 'integer',
    ];

    protected $perPage = 20;

    protected static function boot()
    {
        parent::boot();

        static::observe(VisitorObserver::class);
    }

    /**
     * 配信セット来場者とのリレーションを定義
     *
     * @return HasMany
     */
    public function deliverySetVisitors() : HasMany
    {
        return $this->hasMany('App\Models\DeliverySetVisitor');
    }

    /**
     * メール配信ログ来場者テーブルとのリレーションを定義
     * （保有メールアドレス）
     *
     * @return HasMany
     */
    public function deliveryMailLogs() : HasMany
    {
        return $this->hasMany('App\Models\DeliveryMailLogVisitor', 'to', 'email');
    }

    /**
     * Search
     *
     * @param Request $request
     * @return Builder
     */
    public static function search(Request $request) : Builder
    {
        $query = self::query();

        $query->select( \DB::raw('
            visitors.id,
            visitors.name,
            visitors.organization,
            visitors.department,
            visitors.position,
            visitors.postcode,
            visitors.address,
            visitors.email,
            visitors.tel,
            visitors.fax,
            visitors.possible_delivery_flag,
            visitors.exhibitor_type,
            visitors.enterprise_type,
            visitors.created_at,
            visitors.updated_at,
            visitors.deleted_at
        '));

        $query->when($request->has('id_s'), function($query) use ($request) {
            $query->where('visitors.id', '>=', $request->get('id_s'));
        });

        $query->when($request->has('id_e'), function($query) use ($request) {
            $query->where('visitors.id', '<=', $request->get('id_e'));
        });

        $query->when($request->has('name'), function($query) use ($request) {
            $query->where('visitors.name', 'like', "%{$request->get('name')}%");
        });

        $query->when($request->has('organization'), function($query) use ($request) {
            $query->where('visitors.organization', 'like', "%{$request->get('organization')}%");
        });

        $query->when($request->has('department'), function($query) use ($request) {
            $query->where('visitors.department', 'like', "%{$request->get('department')}%");
        });

        $query->when($request->has('position'), function($query) use ($request) {
            $query->where('visitors.position', 'like', "%{$request->get('position')}%");
        });

        $query->when($request->has('postcode'), function($query) use ($request) {
            $query->where('visitors.postcode', 'like', "%{$request->get('postcode')}%");
        });

        $query->when($request->has('address'), function($query) use ($request) {
            $query->where('visitors.address', 'like', "%{$request->get('address')}%");
        });

        $query->when($request->has('email'), function($query) use ($request) {
            $query->where('visitors.email', 'like', "%{$request->get('email')}%");
        });

        $query->when($request->has('tel'), function($query) use ($request) {
            $query->where('visitors.tel', 'like', "%{$request->get('tel')}%");
        });

        $query->when($request->has('fax'), function($query) use ($request) {
            $query->where('visitors.fax', 'like', "%{$request->get('fax')}%");
        });

//         $query->when($request->has('status_on'), function($query) {
//             $query->where('visitors.status', '=', 1);
//         });

//         $query->when($request->has('status_off'), function($query) {
//             $query->where('visitors.status', '=', 0);
//         });

        $query->when($request->has('possible_delivery_flag_on'), function($query) {
            $query->where('visitors.possible_delivery_flag', '=', 1);
        });

        $query->when($request->has('possible_delivery_flag_off'), function($query) {
            $query->where('visitors.possible_delivery_flag', '=', 0);
        });

        $query->when(!empty($request->get('exhibitor_type')), function($query) use ($request) {
            $query->where('visitors.exhibitor_type', '=', $request->get('exhibitor_type'));
        });

        $query->when(!empty($request->get('enterprise_type')), function($query) use ($request) {
            $query->where('visitors.enterprise_type', '=', $request->get('enterprise_type'));
        });

        $query->when($request->has('with_trashed'), function($query) {
            $query->withTrashed();
        });

        $query->orderBy('visitors.created_at', 'DESC');

        return $query;
    }

}
