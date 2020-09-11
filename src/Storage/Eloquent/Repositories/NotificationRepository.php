<?php

namespace Izt\Users\Storage\Eloquent\Repositories;

use Izt\Users\Storage\Interfaces\NotificationRepositoryInterface;
use Illuminate\Notifications\DatabaseNotification;
use Izt\Helpers\Storage\Eloquent\Repositories\AbstractRepository;

/**
 * Class NotificationRepository
 * @package App\Storage\Eloquent\Repositories
 */
class NotificationRepository extends AbstractRepository implements NotificationRepositoryInterface
{
    /**
     * NotificationRepository constructor.
     * @param DatabaseNotification $model
     */

    public function __construct(DatabaseNotification $model)
    {
        parent::__construct($model);
    }

}

