<?php

namespace Izt\Basics\Http\UIComponents;

class RoleComponents
{

    /* Index */

    public function prepareBreadcrumbsIndex()
    {
        return [
            [
                'title' => trans_choice('basics::basics.role', 2)
            ]
        ];
    }

    public function prepareButtonsIndex()
    {
        return [
            'partial_route' => 'roles',
            'list' => true,
            'create' => true,
            'nonactive' => true,
            'trash' => true
        ];
    }

    /* NonActive */

    public function prepareBreadcrumbsNonActive()
    {
        return [
            [
                'title' => trans_choice('basics::basics.role', 2),
                'route' => route('roles.index')
            ],
            [
                'title' => trans('basics::action.nonactive')
            ]
        ];
    }

    public function prepareButtonsNonActive()
    {
        return [
            'partial_route' => 'roles',
            'list' => true,
            'nonactive' => true
        ];
    }

    /* Trash */

    public function prepareBreadcrumbsTrash()
    {
        return [
            [
                'title' => trans_choice('basics::basics.role', 2),
                'route' => route('roles.index')
            ],
            [
                'title' => trans_choice('basics::action.trash', 2)
            ],
        ];
    }

    public function prepareButtonsTrash()
    {
        return [
            'partial_route' => 'roles',
            'list' => true,
            'trash' => true
        ];
    }

    /* Create */

    public function prepareBreadcrumbsCreate()
    {
        return [
            [
                'title' => trans_choice('basics::basics.role', 2),
                'route' => route('roles.index')
            ],
            [
                'title' => trans('basics::action.create')
            ]
        ];
    }

    public function prepareButtonsCreate()
    {
        return [
            'partial_route' => 'roles',
            'list' => true
        ];
    }

    public function prepareFormCreate()
    {
        return [
            'action' => route('roles.store'),
            'button' => trans('basics::action.create')
        ];
    }

    /* Edit */

    public function prepareBreadcrumbsEdit($title)
    {
        return [
            [
                'title' => trans_choice('basics::basics.role', 2),
                'route' => route('roles.index')
            ],
            [
                'title' => $title
            ]
        ];
    }

    public function prepareButtonsEdit()
    {
        return [
            'partial_route' => 'roles',
            'list' => true,
            'create' => true,
        ];
    }

    public function prepareFormEdit($id)
    {
        return [
            'action' => route('roles.update', $id),
            'button' => trans('basics::action.save')
        ];
    }
}
