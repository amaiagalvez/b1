<?php

namespace Izt\Basics\Http\UIComponents;

class VersionComponents
{

    /* Index */

    public function prepareBreadcrumbsIndex()
    {
        return [
            [
                'title' => trans_choice('basics::basics.version', 2)
            ]
        ];
    }

    public function prepareButtonsIndex()
    {
        return [];
    }
}
