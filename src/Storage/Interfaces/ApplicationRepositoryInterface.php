<?php

namespace Izt\Basics\Storage\Interfaces;

/**
 * Class ApplicationRepository
 * @package App\Storage\Eloquent\Repositories
 */
interface ApplicationRepositoryInterface
{
    public function allListed(
        array $with = null,
        $order = ['created_at' => 'desc'],
        array $filters = [],
        $onlyTrashed = false
    );
}
