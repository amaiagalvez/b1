<?php namespace Izt\Basics\Http\Presenters;

use Illuminate\Support\Facades\App;

abstract class AbstractPresenter
{
    protected $model;

    /**
     * AbstractPresenter constructor.
     * @param $model
     */
    public function __construct($model)
    {
        $this->model = $model;
    }

    /**
     * @param $property
     * @return mixed
     */
    public function __get($property)
    {
        if (method_exists($this, $property)) {
            return $this->{$property}();
        }

        return $this->model->{$property};
    }

    /**
     * @param $field
     * @return string
     */
    public function FieldName($field)
    {
        $lang = App::getLocale();

        return $field . '_' . $lang;
    }
}
