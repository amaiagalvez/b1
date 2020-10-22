<?php

namespace Izt\Basics\Http\DtGenerators;

use DB;
use Illuminate\Database\Eloquent\Builder;
use Izt\Basics\Http\Transformers\SessionTransformer;

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
            ->orderColumn('total', function ($query, $order) {
                if (env('APP_ENV') == 'testing') {
                    $query->orderBy(DB::raw('login_at - logout_at'), $order);
                } else {
                    $query->orderBy(DB::raw('TIMESTAMPDIFF(SECOND, login_at,logout_at)'), $order);
                }
            })
            ->setTransformer($this->sessionTransformer)
            ->setRowId(function ($session) {
                return $session->id;
            })
            ->toJson();
    }

}
