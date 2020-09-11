<?php

namespace Izt\Users\Storage\Eloquent\Repositories;

use Izt\Helpers\Storage\Eloquent\Repositories\AbstractRepository;
use Izt\Users\Storage\Eloquent\Models\Module;
use Izt\Users\Storage\Interfaces\ModuleRepositoryInterface;

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

