<?php namespace Izt\Basics\Http\Presenters;

use App;
use Izt\Basics\Http\Presenters\AbstractPresenter;

class VersionPresenter extends AbstractPresenter
{
    public function notes()
    {
        $lang = App::getLocale();

        $field = 'notes_' . $lang;

        return $this->{$field};
    }
}
