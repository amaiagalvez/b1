<?php

namespace Izt\Basics\Http\Validators;

use Illuminate\Support\Arr;

/**
 * Class VersionValidator
 * @package Izt\Basics\Http\Validators
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
            'application_id',
            'name'
        ]);
    }

    /**
     * @var array
     */
    protected $store_rules = [
        'application_id' => 'nullable|exists:APP_applications,id',
        'name' => 'max:255|required_if:parent_id,==,0'
    ];

    /**
     * @var array
     */
    protected $update_rules = [
        'application_id' => 'nullable|exists:APP_applications,id',
        'name' => 'max:255|required_if:parent_id,==,0'
    ];

    /**
     * @var array
     */
    protected $delete_rules = [

    ];

}


