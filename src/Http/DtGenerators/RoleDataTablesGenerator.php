<?php

namespace Izt\Users\Http\DtGenerators;

use Illuminate\Database\Eloquent\Builder;
use Izt\Users\Http\Transformers\RoleTransformer;

class RoleDataTablesGenerator
{
    /**
     * @var Builder
     */
    private $builder;
    /**
     * @var RoleTransformer
     */
    private $roleTransformer;

    /**
     * RoleDataTablesGenerator constructor.
     * @param Builder $builder
     * @param RoleTransformer $roleTransformer
     */
    public function __construct(Builder $builder, RoleTransformer $roleTransformer)
    {
        $this->builder = $builder;
        $this->roleTransformer = $roleTransformer;
    }

    /**
     * @return mixed
     */
    public function get()
    {
        return datatables()
            ->eloquent($this->builder)
            ->orderColumn('name', function ($query, $order) {
                $query->orderBy('name', $order);
            })
            ->setTransformer($this->roleTransformer)
            ->setRowId(function ($role) {
                return $role->id;
            })
            ->toJson();
    }

}
