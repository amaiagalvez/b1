<?php namespace Izt\Basics\Http\Presenters;

use App;
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
