<?php

namespace Izt\Basics\Http\UIComponents;

class UserComponents
{

    /* Index */

    public function prepareBreadcrumbsIndex()
    {
        return [
            [
                'title' => trans_choice('basics::basics.user', 2)
            ]
        ];
    }

    public function prepareButtonsIndex($languages)
    {
        return [
            'partial_route' => 'users',
            'list' => true,
            'create' => true,
            'nonactive' => true,
            'trash' => true,
            'languages' => $languages
        ];
    }

    /* NonActive */

    public function prepareBreadcrumbsNonActive()
    {
        return [
            [
                'title' => trans_choice('basics::basics.user', 2),
                'route' => route('users.index')
            ],
            [
                'title' => trans('basics::action.nonactive')
            ]
        ];
    }

    public function prepareButtonsNonActive()
    {
        return [
            'partial_route' => 'users',
            'list' => true,
            'nonactive' => true
        ];
    }

    /* Trash */

    public function prepareBreadcrumbsTrash()
    {
        return [
            [
                'title' => trans_choice('basics::basics.user', 2),
                'route' => route('users.index')
            ],
            [
                'title' => trans_choice('basics::action.trash', 2)
            ],
        ];
    }

    public function prepareButtonsTrash()
    {
        return [
            'partial_route' => 'users',
            'list' => true,
            'trash' => true
        ];
    }

    /* Create */

    public function prepareBreadcrumbsCreate()
    {
        return [
            [
                'title' => trans_choice('basics::basics.user', 2),
                'route' => route('users.index')
            ],
            [
                'title' => trans('basics::action.create')
            ]
        ];
    }

    public function prepareButtonsCreate()
    {
        return [
            'partial_route' => 'users',
            'list' => true
        ];
    }

    public function prepareFormCreate()
    {
        return [
            'action' => route('users.store'),
            'button' => trans('basics::action.create')
        ];
    }

    /* Edit */

    public function prepareBreadcrumbsEdit($title)
    {
        return [
            [
                'title' => trans_choice('basics::basics.user', 2),
                'route' => route('users.index')
            ],
            [
                'title' => $title
            ]
        ];
    }

    public function prepareButtonsEdit()
    {
        return [
            'partial_route' => 'users',
            'list' => true,
            'create' => true,
        ];
    }

    public function prepareFormEdit($id)
    {
        return [
            'action' => route('users.update', $id),
            'button' => trans('basics::action.save')
        ];
    }

    /* Profile */

    public function prepareBreadcrumbsProfile($title)
    {
        return [
            [
                'title' => trans_choice('basics::basics.user', 2)
            ],
            [
                'title' => $title
            ]
        ];
    }

    public function prepareButtonsProfile()
    {
        return [];
    }

    public function prepareFormProfile($id)
    {
        return [
            'action' => route('users.update', $id),
            'button' => trans('basics::action.save')
        ];
    }
}
