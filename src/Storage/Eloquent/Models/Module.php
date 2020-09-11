<?php

namespace Izt\Users\Storage\Eloquent\Models;

use Izt\Users\Http\Presenters\ModulePresenter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Izt\Helpers\Http\Presenters\PresentableTrait;
use Izt\Helpers\Storage\Eloquent\Traits\AbstractTrait;

class Module extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'APP_modules';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title_eu',
        'title_es',
        'title_fr',
        'title_en',
        'name',
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

    protected $presenter = ModulePresenter::class;

    use AbstractTrait;
    use PresentableTrait;
    use SoftDeletes;

    /* Relations */

    public function menus()
    {
        return $this->hasMany(Menu::class, 'module_id');
    }

    public function versions()
    {
        return $this->hasMany(Version::class, 'module_id');
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'APP_modules_roles', 'module_id', 'role_id')->withTimestamps();
    }

    /* Scopes */

    public function scopeActive($query, $value)
    {
        if ($value >= 0 && $value <= 1) {
            return $query->where('active', $value);
        }
        return $query;
    }
}
