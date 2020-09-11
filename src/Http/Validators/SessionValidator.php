<?php

namespace Izt\Users\Http\Validators;


use Illuminate\Support\Arr;
use Izt\Helpers\Http\Validators\AbstractValidator;

/**
 * Class SessionValidator
 * @package Izt\Users\Http\Validators
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


