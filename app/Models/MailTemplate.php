<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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
        //
    ];

    protected $perPage = 20;

    /**
     * Search
     *
     * @param array $search
     */
    public static function search($search)
    {
        $query = self::query();

        $query->select( \DB::raw('
            mail_templates.id,
            mail_templates.subject,
            mail_templates.from,
            mail_templates.content,
            mail_templates.created_at,
            mail_templates.updated_at,
            mail_templates.deleted_at'
        ));

        // ID
        if( !empty($search['id']) ) {
            $query->where('mail_templates.id', '=', $search['id']);
        }

        // 登録時間の降順
        $query->orderBy('mail_templates.created_at', 'DESC');

        return $query;
    }
}
