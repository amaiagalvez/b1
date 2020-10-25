<?php

namespace Izt\Basics\Storage\Eloquent\Repositories;

use Izt\Basics\Storage\Eloquent\Models\Area;
use Izt\Basics\Storage\Interfaces\AreaRepositoryInterface;

/**
 * Class AreaRepository
 * @package Izt\Basics\Storage\Eloquent\Repositories
 */
class AreaRepository extends AbstractRepository implements AreaRepositoryInterface
{
    /**
     * AreaRepository constructor.
     * @param Area $model
     */

    public function __construct(Area $model)
    {
        parent::__construct($model);
    }

}

