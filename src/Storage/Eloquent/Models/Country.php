<?php

namespace Izt\Basics\Storage\Eloquent\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Izt\Basics\Storage\Eloquent\Traits\AbstractTrait;

class Country extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'LOC_countries';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'state_id',
        'name',
        'short_name',
        'code',
        'active',
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
        'active' => 'boolean'
    ];

    use AbstractTrait;
    use SoftDeletes;

    /* Relations */

    public function state()
    {
        return $this->belongsTo(State::class);
    }

    public function districs()
    {
        return $this->hasMany(District::class);
    }

    /* Scopes */

    public function scopeActive($query, $value)
    {
        if ($value >= 0 && $value <= 1) {
            return $query->where('active', $value);
        }
        return $query;
    }

    public function canDelete()
    {
        return $this->districs->count() === 0;
    }
}
