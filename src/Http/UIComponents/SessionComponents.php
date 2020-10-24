<?php

namespace Izt\Basics\Http\UIComponents;

class SessionComponents
{

    /* Index */

    public function prepareBreadcrumbsIndex()
    {
        return [
            [
                'title' => trans_choice('basics::basics.session', 2)
            ]
        ];
    }

    public function prepareButtonsIndex($years, $users, $user_id)
    {
        return [
            'partial_route' => 'sessions',
            'years' => $years,
            'selects' => [
                [
                    'name' => 'user',
                    'options' => $users,
                    'value' => $user_id
                ]
            ]
        ];
    }
}
