<?php

namespace Izt\Users\Storage\Eloquent\Repositories;

use Izt\Users\Storage\Eloquent\Models\Session;
use Izt\Users\Storage\Interfaces\SessionRepositoryInterface;
use Izt\Helpers\Storage\Eloquent\Repositories\AbstractRepository;

/**
 * Class SessionRepository
 * @package App\Storage\Eloquent\Repositories
 */
class SessionRepository extends AbstractRepository implements SessionRepositoryInterface
{
    /**
     * SessionRepository constructor.
     * @param Session $model
     */

    public function __construct(Session $model)
    {
        parent::__construct($model);
    }

    public function findBySessionToken($token)
    {
        return $this->model->where('session_token', $token)->first();
    }
}

