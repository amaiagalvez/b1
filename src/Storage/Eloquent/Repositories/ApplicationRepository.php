<?php

namespace Izt\Basics\Storage\Eloquent\Repositories;

use Izt\Basics\Storage\Eloquent\Models\Application;
use Izt\Basics\Storage\Interfaces\ApplicationRepositoryInterface;

/**
 * Class ApplicationRepository
 * @package Izt\Basics\Storage\Eloquent\Repositories
 */
class ApplicationRepository extends AbstractRepository implements ApplicationRepositoryInterface
{
    /** ApplicationRepository constructor.
     * @param Application $model
     */

    public function __construct(Application $model)
    {
        parent::__construct($model);
    }

}

