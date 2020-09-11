<?php

namespace Izt\Users\Storage\Interfaces;

/**
 * Class SessionRepository
 * @package App\Storage\Eloquent\Repositories
 */
interface SessionRepositoryInterface
{

    public function findBySessionToken($token);

    public function create(array $data);

    public function applyFiltersAndOrderQuery(
        $query,
        $onlyTrashed,
        $filters,
        $order
    );
}
