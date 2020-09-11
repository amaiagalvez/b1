<?php

namespace Izt\Users\Http\DtGenerators;

use Illuminate\Database\Eloquent\Builder;
use Izt\Users\Http\Transformers\SessionTransformer;

class SessionDataTablesGenerator
{
    /**
     * @var Builder
     */
    private $builder;
    /**
     * @var SessionTransformer
     */
    private $sessionTransformer;

    /**
     * SessionDataTablesGenerator constructor.
     * @param Builder $builder
     * @param SessionTransformer $sessionTransformer
     */
    public function __construct(Builder $builder, SessionTransformer $sessionTransformer)
    {
        $this->builder = $builder;
        $this->sessionTransformer = $sessionTransformer;
    }

    /**
     * @return mixed
     */
    public function get()
    {

        return datatables()
            ->eloquent($this->builder)
            ->orderColumn('login_at', function ($query, $order) {
                $query->orderBy('login_at', $order);
            })
            ->setTransformer($this->sessionTransformer)
            ->setRowId(function ($session) {
                return $session->id;
            })
            ->toJson();
    }

}
