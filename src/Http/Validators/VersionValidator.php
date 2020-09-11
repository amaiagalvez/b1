<?php

namespace Izt\Users\Http\Validators;

use Illuminate\Support\Arr;
use Izt\Helpers\Http\Validators\AbstractValidator;

/**
 * Class VersionValidator
 * @package Izt\Users\Http\Validators
 */
class VersionValidator extends AbstractValidator
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
            'parent_id'
        ]);
    }

    /**
     * @var array
     */
    protected $store_rules = [
        'name' => 'max:30|required_if:parent_id,==,0'
    ];

    /**
     * @var array
     */
    protected $update_rules = [
        'name' => 'max:30|required_if:parent_id,==,0'
    ];

    /**
     * @var array
     */
    protected $delete_rules = [

    ];

}


