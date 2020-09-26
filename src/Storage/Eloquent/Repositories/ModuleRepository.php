<?php

namespace Izt\Basics\Storage\Eloquent\Repositories;

use Izt\Helpers\Storage\Eloquent\Repositories\AbstractRepository;
use Izt\Basics\Storage\Eloquent\Models\Module;
use Izt\Basics\Storage\Interfaces\ModuleRepositoryInterface;

/**
 * Class ModuleRepository
 * @package App\Storage\Eloquent\Repositories
 */
class ModuleRepository extends AbstractRepository implements ModuleRepositoryInterface
{
    /** ModuleRepository constructor.
     * @param Module $model
     */

    public function __construct(Module $model)
    {
        parent::__construct($model);
    }

}

