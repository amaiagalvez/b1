<?php

namespace Izt\Users\Http\DtGenerators;

use Izt\Users\Http\Transformers\UserTransformer;
use Illuminate\Database\Eloquent\Builder;

class UserDataTablesGenerator
{
    /**
     * @var Builder
     */
    private $builder;
    /**
     * @var UserTransformer
     */
    private $userTransformer;

    /**
     * UserDataTablesGenerator constructor.
     * @param Builder $builder
     * @param UserTransformer $userTransformer
     */
    public function __construct(Builder $builder, UserTransformer $userTransformer)
    {
        $this->builder = $builder;
        $this->userTransformer = $userTransformer;
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
            ->setTransformer($this->userTransformer)
            ->setRowId(function ($user) {
                return $user->id;
            })
            ->toJson();
    }

}
