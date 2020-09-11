<?php

namespace Izt\Users\Http\Validators;

use Illuminate\Support\Arr;
use Izt\Helpers\Http\Validators\AbstractValidator;

/**
 * Class MenuValidator
 * @package Izt\Users\Http\Validators
 */
class MenuValidator extends AbstractValidator
{

    protected $id = null;

    /** Get the prepared input data.
     *
     * @return array
     */
    public function getInputData()
    {
        return Arr::only($this->inputData, [
            'name',
            'route',
            'icon',
            'parent_id'
        ]);
    }

    /**
     * @var array
     */
    protected $store_rules = [

    ];

    /**
     * @var array
     */
    protected $update_rules = [
        'name' => 'required|max:255',
        'route' => 'required|max:255',
        'icon' => 'required|max:255',
        'parent_id' => 'nullable|exists:APP_menus,id'
    ];

    /**
     * @var array
     */
    protected $delete_rules = [

    ];

}


