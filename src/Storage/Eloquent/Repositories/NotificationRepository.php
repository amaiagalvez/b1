<?php

namespace Izt\Basics\Storage\Eloquent\Repositories;

use Illuminate\Notifications\DatabaseNotification;
use Izt\Basics\Storage\Interfaces\NotificationRepositoryInterface;
use Izt\Helpers\Storage\Eloquent\Repositories\AbstractRepository;

/**
 * Class NotificationRepository
 * @package Izt\Basics\Storage\Eloquent\Repositories
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

