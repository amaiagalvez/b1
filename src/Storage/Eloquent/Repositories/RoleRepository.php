<?php

namespace Izt\Basics\Storage\Eloquent\Repositories;

use Izt\Helpers\Storage\Eloquent\Repositories\AbstractRepository;
use Izt\Basics\Storage\Eloquent\Models\Role;
use Izt\Basics\Storage\Interfaces\RoleRepositoryInterface;

/**
 * Class RoleRepository
 * @package App\Storage\Eloquent\Repositories
 */
class RoleRepository extends AbstractRepository implements RoleRepositoryInterface
{
    /** RoleRepository constructor.
     * @param Role $model
     */

    public function __construct(Role $model)
    {
        parent::__construct($model);
    }

    public function getList(
        $empty = false,
        array $filters = [],
        $field = 'name'
    ) {
        $query = $this->model->orderBy($field, 'asc');

        foreach ($filters as $key => $value) {
            $query->{$key}($value);
        }

        $roles = $query->get();

        $list = [];

        if ($empty) {
            $list[''] = '--';
        }

        foreach ($roles as $item) {
            $list[$item->name] = $item->present()->title;
        }

        return $list;
    }


    /**
     * @param Role $role
     * @return array
     */
    public function getRoleModules(Role $role)
    {
        $role_modules = $role->modules()->get();
        $list = [];
        foreach ($role_modules as $rm) {
            $list[] = $rm->id;
        }

        return $list;
    }

    /**
     * @param Role $role
     * @param array $modules
     * @return array
     */
    public function syncModules(Role $role, array $modules = [])
    {
        return $role->modules()->sync($modules);
    }
}

