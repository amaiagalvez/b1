<?php

namespace Izt\Basics\Storage\Interfaces;

/**
 * Class MenuRepository
 * @package Izt\Basics\Storage\Eloquent\Repositories
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
