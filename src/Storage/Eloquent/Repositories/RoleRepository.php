<?php

namespace Izt\Basics\Storage\Eloquent\Repositories;

use Izt\Basics\Storage\Eloquent\Models\Role;
use Izt\Basics\Storage\Interfaces\RoleRepositoryInterface;
use Izt\Basics\Storage\Eloquent\Repositories\AbstractRepository;

/**
 * Class RoleRepository
 * @package Izt\Basics\Storage\Eloquent\Repositories
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
}

