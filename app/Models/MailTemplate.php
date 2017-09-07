<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
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
        'from'   => 'integer',
//         'status' => 'boolean',

    ];

    protected $perPage = 20;

    /**
     * 配信セットとのリレーションを定義
     *
     * @return HasMany
     */
    public function deliverySets() : HasMany
    {
        return $this->hasMany('App\Models\DeliverySet');
    }

    /**
     * 配信セット来場者テーブルとのリレーションを定義
     *
     * @return HasMany
     */
    public function deliverySetVisitors() : HasMany
    {
        return $this->hasMany('App\Models\DeliverySetVisitor');
    }

    /**
     * メール配信ログテーブルとのリレーションを定義
     *
     * @return HasMany
     */
    public function deliveryMailLogs() : HasMany
    {
        return $this->hasMany('App\Models\DeliveryMailLog');
    }

    /**
     * Search
     *
     * @param array $search
     * @return Builder
     */
    public static function search(array $search = []) : Builder
    {
        $query = self::query();

        $query->select( \DB::raw('
            mail_templates.id,
            mail_templates.subject,
            mail_templates.from,
            mail_templates.content,
            mail_templates.status,
            mail_templates.created_at,
            mail_templates.updated_at,
            mail_templates.deleted_at
        '));

        // ID
        if( !empty($search['id']) ) {
            $query->where('mail_templates.id', '=', $search['id']);
        }

        $query->orderBy('mail_templates.created_at', 'DESC');

        if( app()->isLocal() ) {
            $query->withTrashed();
        }

        return $query;
    }
}
