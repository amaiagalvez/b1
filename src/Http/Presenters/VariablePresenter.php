<?php namespace Izt\Users\Http\Presenters;

use App;
use Izt\Helpers\Http\Presenters\AbstractPresenter;

class VariablePresenter extends AbstractPresenter
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
