<?php

namespace Izt\Basics\Storage\Interfaces;

use Illuminate\Database\Eloquent\Model;
use Izt\Basics\Storage\Eloquent\Models\Role;

/**
 * Class RoleRepository
 * @package App\Storage\Eloquent\Repositories
 */
interface RoleRepositoryInterface
{
    public function getNew(array $attributes = []);

    public function findById($id);

    public function applyFiltersAndOrderQuery(
        $query,
        $onlyTrashed,
        $filters,
        $order
    );

    public function getList(
        $empty = false,
        array $filters = [],
        $field = 'name'
    );

    public function create(array $data);

    public function update(
        Model $model,
        array $data
    );

    public function restore($id);

    public function destroy($id);

    public function secureDelete(Model $model, $relations);

    public function getRoleModules(Role $role);

    public function syncModules(Role $role, array $modules = []);

}
