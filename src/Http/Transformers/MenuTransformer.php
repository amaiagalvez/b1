<?php

namespace Izt\Users\Http\Transformers;

use Izt\Users\Storage\Eloquent\Models\Menu;
use League\Fractal\TransformerAbstract;

class MenuTransformer extends TransformerAbstract
{

    protected $defaultIncludes = [];

    /**
     * @var null
     */
    private $list_type;

    /**
     * MenuTransformer constructor.
     * @param null $list_type
     */
    public function __construct($list_type = null)
    {
        $this->list_type = $list_type;
    }

    public function transform(Menu $menu = null)
    {
        if ($menu === null) {
            return [];
        }

        return [
            'id' => $menu->id,
            'name' => $menu->name,
            'actions' => ''
        ];

    }
}
