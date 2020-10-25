<?php

namespace Izt\Basics\Storage\Eloquent\Repositories;

use Izt\Basics\Storage\Eloquent\Models\Country;
use Izt\Basics\Storage\Interfaces\CountryRepositoryInterface;

/**
 * Class CountryRepository
 * @package Izt\Basics\Storage\Eloquent\Repositories
 */
class CountryRepository extends AbstractRepository implements CountryRepositoryInterface
{
    /**
     * CountryRepository constructor.
     * @param Country $model
     */

    public function __construct(Country $model)
    {
        parent::__construct($model);
    }

}

