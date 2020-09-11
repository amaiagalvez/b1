<?php namespace Izt\Users\Http\Presenters;

use App;
use Izt\Helpers\Http\Presenters\AbstractPresenter;

class VersionPresenter extends AbstractPresenter
{
    public function notes()
    {
        $lang = App::getLocale();

        $field = 'notes_' . $lang;

        return $this->{$field};
    }
}
