<?php

namespace Izt\Basics\Storage\Eloquent\Repositories;

use Izt\Basics\Storage\Eloquent\Models\District;
use Izt\Basics\Storage\Interfaces\DistrictRepositoryInterface;

/**
 * Class DistrictRepository
 * @package Izt\Basics\Storage\Eloquent\Repositories
 */
class DistrictRepository extends AbstractRepository implements DistrictRepositoryInterface
{
    /**
     * DistrictRepository constructor.
     * @param District $model
     */

    public function __construct(District $model)
    {
        parent::__construct($model);
    }

}

