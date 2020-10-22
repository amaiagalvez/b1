<?php

namespace Izt\Basics\Http\Validators;

use Illuminate\Support\Arr;

/**
 * Class VariableValidator
 * @package Izt\Basics\Http\Validators
 */
class VariableValidator extends AbstractValidator
{

    protected $id = null;

    /** Get the prepared input data.
     *
     * @return array
     */
    public function getInputData()
    {
        return Arr::only($this->inputData, [
            'value'
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
        'value' => 'required'
    ];

    /**
     * @var array
     */
    protected $delete_rules = [

    ];

}


