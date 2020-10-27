<?php

namespace Izt\Basics\Storage\Eloquent\Repositories;

use Izt\Basics\Storage\Eloquent\Models\Community;
use Izt\Basics\Storage\Interfaces\CommunityRepositoryInterface;

/**
 * Class CommunityRepository
 * @package Izt\Basics\Storage\Eloquent\Repositories
 */
class CommunityRepository extends AbstractRepository implements CommunityRepositoryInterface
{
    /**
     * CommunityRepository constructor.
     * @param Community $model
     */

    public function __construct(Community $model)
    {
        parent::__construct($model);
    }

}

