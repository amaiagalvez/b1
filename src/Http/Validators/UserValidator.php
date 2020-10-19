<?php

namespace Izt\Basics\Http\Validators;


use Illuminate\Support\Arr;
use Izt\Basics\Http\Validators\AbstractValidator;

/**
 * Class UserValidator
 * @package Izt\Basics\Http\Validators
 */
class UserValidator extends AbstractValidator
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
            'email',
            'password',
            'password_confirmation',
            'role_name',
            'lang'
        ]);
    }

    /**
     * @var array
     */
    protected $store_rules = [
        'name' => 'required|string|min:3|max:255',
        'email' => 'required|email|min:5|max:255|unique:users,email',
        'lang' => 'required|max:2|in:eu,es,fr,en',
        'role_name' => 'required|max:30|exists:APP_roles,name',
        'password' => ['string', 'min:6', 'confirmed'],
    ];

    /**
     * @var array
     */
    protected $update_rules = [
        'name' => 'required|string|min:3|max:255',
        'email' => 'required|email|min:5|max:255',
        'lang' => 'required|max:2|in:eu,es,fr,en',
        'role_name' => 'required|max:30|exists:APP_roles,name',
        'password' => ['nullable', 'string', 'min:6', 'confirmed'],
    ];

    /**
     * @var array
     */
    protected $delete_rules = [

    ];

    /**
     * @param $action
     * @return array
     */
    protected function getPreparedRules($action)
    {
        if ($action === 'update') {
            $this->update_rules['email'] .= '|unique:users,email,' . $this->id;
        }

        return $this->{$action}();
    }
}


