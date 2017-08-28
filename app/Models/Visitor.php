<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
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
        //
    ];

    protected $perPage = 20;

    /**
     * Search
     *
     * @param array $search
     */
    public static function search($search = [])
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
            visitors.created_at,
            visitors.updated_at,
            visitors.deleted_at
        '));

        // ID
        if( !empty($search['id']) ) {
            $query->where('visitors.id', '=', $search['id']);
        }

        // 登録時間の降順
        $query->orderBy('visitors.created_at', 'DESC');

        // TODO 仮の措置
        $query->withTrashed();

        return $query;
    }

}
