<?php

namespace Izt\Basics\Storage\Eloquent\Repositories;

use Izt\Basics\Storage\Eloquent\Models\Town;
use Izt\Basics\Storage\Interfaces\TownRepositoryInterface;

/**
 * Class TownRepository
 * @package Izt\Basics\Storage\Eloquent\Repositories
 */
class TownRepository extends AbstractRepository implements TownRepositoryInterface
{
    /**
     * TownRepository constructor.
     * @param Town $model
     */

    public function __construct(Town $model)
    {
        parent::__construct($model);
    }

}

