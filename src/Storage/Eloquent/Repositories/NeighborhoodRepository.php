<?php

namespace Izt\Basics\Storage\Eloquent\Repositories;

use Izt\Basics\Storage\Eloquent\Models\Neighborhood;
use Izt\Basics\Storage\Interfaces\NeighborhoodRepositoryInterface;

/**
 * Class NeighborhoodRepository
 * @package Izt\Basics\Storage\Eloquent\Repositories
 */
class NeighborhoodRepository extends AbstractRepository implements NeighborhoodRepositoryInterface
{
    /**
     * NeighborhoodRepository constructor.
     * @param Neighborhood $model
     */

    public function __construct(Neighborhood $model)
    {
        parent::__construct($model);
    }

}

