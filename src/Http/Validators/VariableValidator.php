<?php

namespace Izt\Users\Http\Validators;

use Illuminate\Support\Arr;
use Izt\Helpers\Http\Validators\AbstractValidator;

/**
 * Class VariableValidator
 * @package Izt\Users\Http\Validators
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


