<?php

namespace Izt\Basics\Storage\Eloquent\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Izt\Basics\Http\Presenters\PresentableTrait;
use Izt\Basics\Http\Presenters\VersionPresenter;
use Izt\Basics\Storage\Eloquent\Traits\AbstractTrait;

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
        'application_id',
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

    ];

    protected $presenter = VersionPresenter::class;

    use AbstractTrait;
    use PresentableTrait;
    use SoftDeletes;

    /* Relations */

    public function application()
    {
        return $this->belongsTo(Application::class);
    }

}
