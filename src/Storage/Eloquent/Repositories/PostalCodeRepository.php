<?php

namespace Izt\Basics\Storage\Eloquent\Repositories;

use Izt\Basics\Storage\Eloquent\Models\PostalCode;
use Izt\Basics\Storage\Interfaces\PostalCodeRepositoryInterface;

/**
 * Class PostalCodeRepository
 * @package Izt\Basics\Storage\Eloquent\Repositories
 */
class PostalCodeRepository extends AbstractRepository implements PostalCodeRepositoryInterface
{
    /**
     * PostalCodeRepository constructor.
     * @param PostalCode $model
     */

    public function __construct(PostalCode $model)
    {
        parent::__construct($model);
    }

}

