<?php

namespace Izt\Basics\Http\Transformers;

use Illuminate\Support\Facades\View;
use Izt\Basics\Storage\Eloquent\Models\Role;
use League\Fractal\TransformerAbstract;

class RoleTransformer extends TransformerAbstract
{

    protected $defaultIncludes = ['application', 'updatedBy', 'deletedBy'];

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

        $data = [
            'id' => $role->id,
            $role->present()->FieldName('title') => $role->present()->title,
            'name' => $role->name,
            $role->present()->FieldName('notes') => $role->present()->notes
        ];

        switch ($this->list_type) {
            case 'index':
                $data['actions'] = View::make('basics::layouts._table.partials._row_buttons_index',
                    [
                        'canEdit' => $role->canEdit(),
                        'canDelete' => $role->canDelete(),
                        'edit_route' => route('roles.edit', $role->id),
                        'deactivate_route' => route('roles.deactivate', $role->id),
                        'delete_route' => route('roles.delete', $role->id)
                    ])->render();
                break;

            case 'trash':
                $data['deleted_at'] = getDataTime($role->deleted_at);
                $data['actions'] = View::make('basics::layouts._table.partials._row_buttons_trash',
                    [
                        'restore_route' => route('roles.restore', $role->id),
                        'destroy_route' => route('roles.destroy', $role->id)
                    ])->render();
                break;

            case 'nonactive':
                $data['updated_at'] = getDataTime($role->updated_at);
                $data['actions'] = View::make('basics::layouts._table.partials._row_buttons_nonactive',
                    ['active_route' => route('roles.activate', $role->id)])->render();
                break;

            default:
                $data['actions'] = '';
                break;
        }

        return $data;
    }

    public function includeApplication(Role $role = null)
    {
        if ($role === null) {
            $application = null;
        } else {
            $application = $role->application;
        }

        return $this->item($application, new ApplicationTransformer());
    }

    public function includeUpdatedBy(Role $role = null)
    {
        if ($role === null) {
            $updatedBy = null;
        } else {
            $updatedBy = $role->updatedBy;
        }

        return $this->item($updatedBy, new BaseTransformer());
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
