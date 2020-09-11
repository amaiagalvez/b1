<?php

namespace Izt\Users\Storage\Eloquent\Repositories;

use Izt\Users\Storage\Eloquent\Models\Version;
use Izt\Users\Storage\Interfaces\VersionRepositoryInterface;
use Izt\Helpers\Storage\Eloquent\Repositories\AbstractRepository;

/**
 * Class VersionRepository
 * @package App\Storage\Eloquent\Repositories
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

