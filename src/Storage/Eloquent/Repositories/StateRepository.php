<?php

namespace Izt\Basics\Storage\Eloquent\Repositories;

use Izt\Basics\Storage\Eloquent\Models\State;
use Izt\Basics\Storage\Interfaces\StateRepositoryInterface;

/**
 * Class StateRepository
 * @package Izt\Basics\Storage\Eloquent\Repositories
 */
class StateRepository extends AbstractRepository implements StateRepositoryInterface
{
    /**
     * StateRepository constructor.
     * @param State $model
     */

    public function __construct(State $model)
    {
        parent::__construct($model);
    }

}

