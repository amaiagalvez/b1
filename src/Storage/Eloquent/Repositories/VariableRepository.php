<?php

namespace Izt\Basics\Storage\Eloquent\Repositories;

use Izt\Helpers\Storage\Eloquent\Repositories\AbstractRepository;
use Izt\Basics\Storage\Eloquent\Models\Variable;
use Izt\Basics\Storage\Interfaces\VariableRepositoryInterface;

/**
 * Class VariableRepository
 * @package App\Storage\Eloquent\Repositories
 */
class VariableRepository extends AbstractRepository implements VariableRepositoryInterface
{
    /** VariableRepository constructor.
     * @param Variable $model
     */

    public function __construct(Variable $model)
    {
        parent::__construct($model);
    }

    public function getValueByName($name)
    {
        return $this->model->where('name', '=', $name)->first()->value ?? '';
    }
}

