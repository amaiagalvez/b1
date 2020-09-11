<?php namespace Izt\Users\Http\Presenters;

use Izt\Helpers\Http\Presenters\AbstractPresenter;

class ModulePresenter extends AbstractPresenter
{
    public function title()
    {
        $lang = App::getLocale();

        $field = 'title_' . $lang;

        return $this->{$field};
    }
}
