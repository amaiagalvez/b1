<?php

namespace Izt\Basics\Http\Validators;


use Illuminate\Support\Arr;
use Izt\Helpers\Http\Validators\AbstractValidator;

/**
 * Class RoleValidator
 * @package Izt\Basics\Http\Validators
 */
class RoleValidator extends AbstractValidator
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
            'title_eu',
            'title_es',
            'title_fr',
            'title_en'
        ]);
    }

    /**
     * @var array
     */
    protected $store_rules = [
        'name' => 'required|string|max:30|unique:APP_roles,name',
        'title_eu' => 'max:30',
        'title_es' => 'max:30',
        'title_fr' => 'max:30',
        'title_en' => 'max:30'
    ];

    /**
     * @var array
     */
    protected $update_rules = [
        'name' => 'required|string|max:30',
        'title_eu' => 'max:30',
        'title_es' => 'max:30',
        'title_fr' => 'max:30',
        'title_en' => 'max:30'
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
            $this->update_rules['name'] .= '|unique:APP_roles,name,' . $this->id;
        }

        return $this->{$action}();
    }
}


