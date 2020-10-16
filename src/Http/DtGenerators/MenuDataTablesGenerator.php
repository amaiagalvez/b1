<?php

namespace Izt\Basics\Http\DtGenerators;

use Illuminate\Database\Eloquent\Builder;
use Izt\Basics\Http\Transformers\MenuTransformer;

class MenuDataTablesGenerator
{
    /**
     * @var Builder
     */
    private $builder;
    /**
     * @var MenuTransformer
     */
    private $menuTransformer;

    /**
     * MenuDataTablesGenerator constructor.
     * @param Builder $builder
     * @param MenuTransformer $menuTransformer
     */
    public function __construct(Builder $builder, MenuTransformer $menuTransformer)
    {
        $this->builder = $builder;
        $this->menuTransformer = $menuTransformer;
    }

    /**
     * @return mixed
     */
    public function get()
    {
        return datatables()
            ->eloquent($this->builder)
            ->orderColumn('id', function ($query, $order) {
                $query->orderBy('id', $order);
            })
            ->setTransformer($this->menuTransformer)
            ->setRowId(function ($menu) {
                return $menu->id;
            })
            ->toJson();
    }

}
