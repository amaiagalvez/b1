<?php

namespace Izt\Users\Storage\Eloquent\Repositories;

use Izt\Helpers\Storage\Eloquent\Repositories\AbstractRepository;
use Izt\Users\Storage\Eloquent\Models\User;
use Izt\Users\Storage\Interfaces\UserRepositoryInterface;

/**
 * Class UserRepository
 * @package App\Storage\Eloquent\Repositories
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

