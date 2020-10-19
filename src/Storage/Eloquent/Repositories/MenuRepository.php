<?php

namespace Izt\Basics\Storage\Eloquent\Repositories;

use Izt\Basics\Storage\Eloquent\Models\Menu;
use Izt\Basics\Storage\Interfaces\MenuRepositoryInterface;
use Izt\Helpers\Storage\Eloquent\Repositories\AbstractRepository;

/**
 * Class MenuRepository
 * @package Izt\Basics\Storage\Eloquent\Repositories
 */
class MenuRepository extends AbstractRepository implements MenuRepositoryInterface
{
    /**
     * MenuRepository constructor.
     * @param Menu $model
     */

    public function __construct(Menu $model)
    {
        parent::__construct($model);
    }

}

