<?php

namespace Izt\Basics\Storage\Eloquent\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Izt\Basics\Http\Presenters\ApplicationPresenter;
use Izt\Basics\Http\Presenters\PresentableTrait;
use Izt\Basics\Storage\Eloquent\Traits\AbstractTrait;

class Application extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'APP_applications';

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
        'icon',
        'active',
        'notes_eu',
        'notes_es',
        'notes_fr',
        'notes_en',
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

    protected $presenter = ApplicationPresenter::class;

    use AbstractTrait;
    use PresentableTrait;
    use SoftDeletes;

    /* Relations */

    public function menus()
    {
        return $this->hasMany(Menu::class, 'application_id');
    }

    public function versions()
    {
        return $this->hasMany(Version::class, 'application_id');
    }

    public function roles()
    {
        return $this->hasMany(Role::class, 'application_id');
    }

    public function variables()
    {
        return $this->hasMany(Variable::class, 'application_id');
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
