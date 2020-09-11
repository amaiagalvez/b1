<?php

namespace Izt\Users\Http\Transformers;

use Izt\Users\Storage\Eloquent\Models\Module;
use League\Fractal\TransformerAbstract;

class ModuleTransformer extends TransformerAbstract
{

    protected $defaultIncludes = [];

    /**
     * @var null
     */
    private $list_type;

    /**
     * ModuleTransformer constructor.
     * @param null $list_type
     */
    public function __construct($list_type = null)
    {
        $this->list_type = $list_type;
    }

    public function transform(Module $module = null)
    {
        if ($module === null) {
            return [];
        }

        return [
            'id' => $module->id,
            'name' => $module->name,
            $module->present()->FieldName('title') => $module->present()->title,
            'actions' => ''
        ];

    }
}
