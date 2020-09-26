<?php

namespace Izt\Basics\Storage\Eloquent\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Izt\Helpers\Http\Presenters\PresentableTrait;
use Izt\Helpers\Storage\Eloquent\Traits\AbstractTrait;
use Izt\Helpers\Storage\Eloquent\Traits\SecureDeleteTrait;
use Izt\Basics\Http\Presenters\RolePresenter;

class Role extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'APP_roles';

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

    protected $presenter = RolePresenter::class;

    use AbstractTrait;
    use PresentableTrait;
    use SecureDeleteTrait;
    use SoftDeletes;

    /* Relations */

    public function users()
    {
        return $this->hasMany(User::class, 'role_name', 'name');
    }

    public function modules()
    {
        return $this->belongsToMany(Module::class, 'APP_modules_roles', 'role_id', 'module_id')->withTimestamps();
    }

    /* Functions */

    public function isAdmin()
    {
        return $this->name === 'admin';
    }

    public function isWebUser()
    {
        return $this->role_name === 'web';
    }


    public function canDelete()
    {
        return $this->users->count() === 0 && !$this->isAdmin() && !$this->isWebUser();
    }
}
