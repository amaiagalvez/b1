<?php namespace Izt\Basics\Http\Presenters;

use App;

class RolePresenter extends AbstractPresenter
{
    public function title()
    {
        $lang = App::getLocale();

        $field = 'title_' . $lang;

        return $this->{$field};
    }

    public function notes()
    {
        $lang = App::getLocale();

        $field = 'notes_' . $lang;

        return $this->{$field};
    }
}
