<?php

namespace Izt\Basics\Http\Validators;


use Illuminate\Support\Arr;

/**
 * Class SessionValidator
 * @package Izt\Basics\Http\Validators
 */
class SessionValidator extends AbstractValidator
{

    protected $id = null;

    /** Get the prepared input data.
     *
     * @return array
     */
    public function getInputData()
    {
        return Arr::only($this->inputData, [
            'user_id'
        ]);
    }

    /**
     * @var array
     */
    protected $store_rules = [
        'user_id' => 'exists:users,id'
    ];

    /**
     * @var array
     */
    protected $update_rules = [
        'user_id' => 'exists:users,id'
    ];

    /**
     * @var array
     */
    protected $delete_rules = [

    ];

}


