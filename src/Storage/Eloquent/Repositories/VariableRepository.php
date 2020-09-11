<?php

namespace Izt\Users\Storage\Eloquent\Repositories;

use Izt\Users\Storage\Eloquent\Models\Variable;
use Izt\Users\Storage\Interfaces\VariableRepositoryInterface;
use Izt\Helpers\Storage\Eloquent\Repositories\AbstractRepository;

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
        return $this->model->where('name', '=', $name)->first()->value;
    }
}

