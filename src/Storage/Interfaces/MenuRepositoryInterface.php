<?php

namespace Izt\Users\Storage\Interfaces;

/**
 * Class MenuRepository
 * @package App\Storage\Eloquent\Repositories
 */
interface MenuRepositoryInterface
{
    public function allListed(
        array $with = null,
        $order = ['created_at' => 'desc'],
        array $filters = [],
        $onlyTrashed = false
    );
}
