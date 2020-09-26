<?php

namespace Izt\Basics\Storage\Interfaces;

use Illuminate\Database\Eloquent\Model;

/**
 * Class VariableRepository
 * @package App\Storage\Eloquent\Repositories
 */
interface VariableRepositoryInterface
{
    public function getValueByName($name);

    public function findById($id);

    public function findByField($field, $value);

    public function applyFiltersAndOrderQuery(
        $query,
        $onlyTrashed,
        $filters,
        $order
    );

    public function update(
        Model $model,
        array $data
    );
}
