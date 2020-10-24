<?php

namespace Izt\Basics\Storage\Eloquent\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Izt\Basics\Storage\Eloquent\Traits\AbstractTrait;

class Town extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'LOC_towns';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'district_id',
        'name',
        'code',
        'capital_city',
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
        'active' => 'boolean',
        'capital_city' => 'boolean'
    ];

    use AbstractTrait;
    use SoftDeletes;

    /* Relations */

    public function district()
    {
        return $this->belongsTo(District::class);
    }

    public function neighborhoods() {
        return $this->hasMany(Neighborhood::class);
    }

    public function areas()
    {
        return $this->belongsToMany(Area::class, 'LOC_area_LOC_town');
    }

    public function postal_codes()
    {
        return $this->hasMany(PostalCode::class);
    }


    /* Scopes */

    public function scopeActive($query, $value)
    {
        if ($value >= 0 && $value <= 1) {
            return $query->where('active', $value);
        }
        return $query;
    }

    /* Functions */

    public function isCapitalCity()
    {
        return $this->capital_city;
    }

    public function canDelete()
    {
        return $this->postal_codes->count() === 0 && $this->neighborhoods->count() === 0 && $this->areas->count() === 0;
    }
}
