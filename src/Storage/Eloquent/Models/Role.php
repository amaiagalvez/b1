<?php

namespace Izt\Basics\Storage\Eloquent\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Izt\Basics\Http\Presenters\PresentableTrait;
use Izt\Basics\Http\Presenters\RolePresenter;
use Izt\Basics\Storage\Eloquent\Traits\AbstractTrait;
use Izt\Basics\Storage\Eloquent\Traits\SecureDeleteTrait;

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
        'application_id',
        'name',
        'title_eu',
        'title_es',
        'title_fr',
        'title_en',
        'notes_eu',
        'notes_es',
        'notes_fr',
        'notes_en',
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

    public function application()
    {
        return $this->belongsTo(Application::class);
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

    public function isAdmin()
    {
        return $this->name === 'admin';
    }

    public function isWebUser()
    {
        return $this->name === 'web';
    }

    public function canEdit()
    {
        return !$this->isAdmin() && !$this->isWebUser();
    }

    public function canDelete()
    {
        return $this->users->count() === 0 && !$this->isAdmin() && !$this->isWebUser();
    }
}
