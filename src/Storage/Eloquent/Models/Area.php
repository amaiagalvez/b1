<?php

namespace Izt\Basics\Storage\Eloquent\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Izt\Basics\Storage\Eloquent\Traits\AbstractTrait;

class Area extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'LOC_areas';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
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

    public function towns()
    {
        return $this->belongsToMany(Town::class, 'LOC_area_LOC_town');
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
        return $this->towns->count() === 0;
    }
}
