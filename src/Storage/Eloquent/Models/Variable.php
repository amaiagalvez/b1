<?php

namespace Izt\Basics\Storage\Eloquent\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Izt\Basics\Http\Presenters\VariablePresenter;
use Izt\Helpers\Http\Presenters\PresentableTrait;
use Izt\Helpers\Storage\Eloquent\Traits\AbstractTrait;

class Variable extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'APP_variables';

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
        'value',
        'editable',
        'show',
        'filed_type',
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
        'editable' => 'boolean',
        'show' => 'boolean'
    ];

    protected $presenter = VariablePresenter::class;

    use AbstractTrait;
    use PresentableTrait;
    use SoftDeletes;

    /* Relations */

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

    public function scopeShow($query, $value)
    {
        if ($value >= 0 && $value <= 1) {
            return $query->where('show', $value);
        }
        return $query;
    }

    /* Functions */

    public function isEditable()
    {
        return $this->editable;
    }
}
