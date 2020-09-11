<?php

namespace Izt\Users\Storage\Eloquent\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Izt\Helpers\Http\Presenters\PresentableTrait;
use Izt\Helpers\Storage\Eloquent\Traits\AbstractTrait;
use Izt\Users\Http\Presenters\VariablePresenter;

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
        'module_id',
        'name',
        'title_eu',
        'title_es',
        'title_fr',
        'title_en',
        'value',
        'editable',
        'development',
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
        'development' => 'boolean',
        'show' => 'boolean',
        'active' => 'boolean'
    ];

    protected $presenter = VariablePresenter::class;

    use AbstractTrait;
    use PresentableTrait;
    use SoftDeletes;

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

    public function scopeDevelopment($query, $value)
    {
        if ($value >= 0 && $value <= 1) {
            return $query->where('development', $value);
        }
        return $query;
    }

    /* Functions */

    public function isEditable()
    {
        return $this->editable;
    }
}
