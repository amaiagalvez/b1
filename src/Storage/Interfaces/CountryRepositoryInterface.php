<?php

namespace Izt\Basics\Storage\Interfaces;

use Illuminate\Database\Eloquent\Model;

/**
 * Class CountryRepository
 * @package Izt\Basics\Storage\Eloquent\Repositories
 */
interface CountryRepositoryInterface
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

    public function activate($id);

    public function deactivate($id);

    public function secureDelete(Model $model, $relations);
}
