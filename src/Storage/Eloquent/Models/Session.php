<?php

namespace Izt\Users\Storage\Eloquent\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Session extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'APP_sessions';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'user_agent',
        'session_token',
        'ip_address',
        'login_at',
        'logout_at',
        'created_by',
        'updated_by',
        'deleted_by'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [

    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [

    ];

    use SoftDeletes;

    /* Relations */

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /* Scopes */

    public function scopeUserId($query, $value)
    {
        if (!empty(trim($value))) {
            $query->where('user_id', $value);
        }

        return $query;
    }

    public function scopeYear($query, $value)
    {
        if (!empty(trim($value))) {

            if(env('DB_CONNECTION') === 'sqlite'){
                return $query->whereRaw('year(login_at) = ?', [$value]);
            }

            return $query->whereYear('login_at', $value);
        }

        return $query;
    }

    /* Attributes */

    public function getTotalAttribute()
    {
        return getDataDiff($this->login_at, $this->logout_at);
    }
}
