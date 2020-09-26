<?php

namespace Izt\Basics\Storage\Eloquent\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Izt\Helpers\Http\Presenters\PresentableTrait;
use Izt\Helpers\Storage\Eloquent\Traits\AbstractTrait;
use Izt\Basics\Http\Presenters\VersionPresenter;

class Version extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'APP_versions';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'module_id',
        'name',
        'parent_id',
        'active',
        'notes_eu',
        'notes_es',
        'notes_fr',
        'notes_en',
        'order',
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

    protected $presenter = VersionPresenter::class;

    use AbstractTrait;
    use PresentableTrait;
    use SoftDeletes;

    /* Relations */

    public function subversions()
    {
        return $this->hasMany(Version::class, 'parent_id')->orderBy('order');
    }

    /* Scopes */

    public function scopeMain($query)
    {
        return $query->whereNull('parent_id');
    }
}
