<?php

namespace Izt\Basics\Storage\Eloquent\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Izt\Helpers\Storage\Eloquent\Traits\AbstractTrait;

class ModuleRole extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'APP_modules_roles';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'role_id',
        'module_id',
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

    use AbstractTrait;
    use SoftDeletes;
}
