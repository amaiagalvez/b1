<?php

namespace Izt\Basics\Storage\Eloquent\Repositories;

use Izt\Basics\Storage\Eloquent\Models\User;
use Izt\Basics\Storage\Interfaces\UserRepositoryInterface;

/**
 * Class UserRepository
 * @package Izt\Basics\Storage\Eloquent\Repositories
 */
class UserRepository extends AbstractRepository implements UserRepositoryInterface
{
    /** UserRepository constructor.
     * @param User $model
     */

    public function __construct(User $model)
    {
        parent::__construct($model);
    }

}

