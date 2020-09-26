<?php

namespace Izt\Basics\Http\DtGenerators;

use Illuminate\Database\Eloquent\Builder;
use Izt\Basics\Http\Transformers\VariableTransformer;

class VariableDataTablesGenerator
{
    /**
     * @var Builder
     */
    private $builder;
    /**
     * @var VariableTransformer
     */
    private $variableTransformer;

    /**
     * VariableDataTablesGenerator constructor.
     * @param Builder $builder
     * @param VariableTransformer $variableTransformer
     */
    public function __construct(Builder $builder, VariableTransformer $variableTransformer)
    {
        $this->builder = $builder;
        $this->variableTransformer = $variableTransformer;
    }

    /**
     * @return mixed
     */
    public function get()
    {
        return datatables()
            ->eloquent($this->builder)
            ->orderColumn('order', function ($query, $order) {
                $query->orderBy('order', $order);
            })
            ->setTransformer($this->variableTransformer)
            ->setRowId(function ($variable) {
                return $variable->id;
            })
            ->toJson();
    }

}
