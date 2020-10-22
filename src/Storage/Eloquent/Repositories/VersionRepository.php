<?php

namespace Izt\Basics\Storage\Eloquent\Repositories;

use Izt\Basics\Storage\Eloquent\Models\Version;
use Izt\Basics\Storage\Interfaces\VersionRepositoryInterface;

/**
 * Class VersionRepository
 * @package Izt\Basics\Storage\Eloquent\Repositories
 */
class VersionRepository extends AbstractRepository implements VersionRepositoryInterface
{
    /**
     * VersionRepository constructor.
     * @param Version $model
     */

    public function __construct(Version $model)
    {
        parent::__construct($model);
    }

}

