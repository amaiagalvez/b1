<?php

namespace Izt\Basics\Storage\Interfaces;

/**
 * Class ModuleRepository
 * @package App\Storage\Eloquent\Repositories
 */
interface ModuleRepositoryInterface
{
    public function allListed(
        array $with = null,
        $order = ['created_at' => 'desc'],
        array $filters = [],
        $onlyTrashed = false
    );
}
