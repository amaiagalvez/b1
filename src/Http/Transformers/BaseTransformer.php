<?php

namespace Izt\Basics\Http\Transformers;

use Illuminate\Database\Eloquent\Model;
use League\Fractal\TransformerAbstract;

class BaseTransformer extends TransformerAbstract
{

    protected $defaultIncludes = [];

    public function __construct()
    {
        //
    }

    public function transform(Model $model = null)
    {
        if ($model === null) {
            return [];
        }

        return [
            'id' => $model->id,
            'name' => $model->name
        ];
    }
}
