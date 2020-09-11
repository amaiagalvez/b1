<?php

namespace Izt\Users\Storage\Eloquent\Repositories;

use Izt\Users\Storage\Eloquent\Models\Menu;
use Izt\Users\Storage\Interfaces\MenuRepositoryInterface;
use Izt\Helpers\Storage\Eloquent\Repositories\AbstractRepository;

/**
 * Class MenuRepository
 * @package App\Storage\Eloquent\Repositories
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

