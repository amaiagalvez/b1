<?php

namespace Izt\Users\Http\Transformers;

use Illuminate\Support\Facades\View;
use Izt\Helpers\Http\Transformers\BaseTransformer;
use Izt\Users\Storage\Eloquent\Models\Role;
use League\Fractal\TransformerAbstract;

class RoleTransformer extends TransformerAbstract
{

    protected $defaultIncludes = ['deletedBy'];

    /**
     * @var null
     */
    private $list_type;

    /**
     * RoleTransformer constructor.
     * @param null $list_type
     */
    public function __construct($list_type = null)
    {
        $this->list_type = $list_type;
    }

    public function transform(Role $role = null)
    {
        if ($role === null) {
            return [];
        }

        $modules = '';
        foreach ($role->modules()->get() as $module) {
            $modules .= label($module->name) . ' ' ?? '';
        }

        $data = [
            'id' => $role->id,
            $role->present()->FieldName('title') => $role->present()->title,
            'name' => $role->name,
            'modules' => $modules,
            $role->present()->FieldName('notes') => $role->present()->notes,
        ];

        switch ($this->list_type) {
            case 'index':
                $data['actions'] = View::make('users::Roles.partials._row_buttons_index', compact('role'))->render();
                break;

            case 'trash':
                $data['deleted_at'] = getDataTime($role->deleted_at);
                $data['actions'] = View::make('users::Roles.partials._row_buttons_trash', compact('role'))->render();
                break;

            default:
                $data['actions'] = '';
                break;
        }

        return $data;
    }

    public function includeDeletedBy(Role $role = null)
    {
        if ($role === null) {
            $deletedBy = null;
        } else {
            $deletedBy = $role->deletedBy;
        }

        return $this->item($deletedBy, new BaseTransformer());
    }

}
