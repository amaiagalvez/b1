<?php

namespace Izt\Basics\Storage\Interfaces;

/**
 * Class VersionRepository
 * @package Izt\Basics\Storage\Eloquent\Repositories
 */
interface VersionRepositoryInterface
{

    public function allListed(
        array $with = null,
        $order = ['created_at' => 'desc'],
        array $filters = [],
        $onlyTrashed = false
    );

}
