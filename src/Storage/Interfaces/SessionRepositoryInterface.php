<?php

namespace Izt\Basics\Storage\Interfaces;

/**
 * Class SessionRepository
 * @package Izt\Basics\Storage\Eloquent\Repositories
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

    public function getYearsList($field);
}
