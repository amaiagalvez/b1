<?php

namespace Izt\Basics\Http\UIComponents;

class RolesComponents
{

    /* Index */

    public function prepareBreadcrumbsIndex()
    {
        return [
            [
                'title' => trans_choice('basics.role', 2)
            ]
        ];
    }

    public function prepareButtonsIndex()
    {
        return [
            'partial_route' => 'roles',
            'list' => true,
            'create' => true,
            'trash' => true
        ];
    }

    /* Trash */

    public function prepareBreadcrumbsTrash()
    {
        return [
            [
                'title' => trans_choice('basics.role', 2),
                'route' => route('roles.index')
            ],
            [
                'title' => trans_choice('basics.trash', 2)
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

    /* Edit */

    public function prepareBreadcrumbsCreate($title)
    {
        return [
            [
                'title' => trans_choice('basics.role', 2),
                'route' => route('roles.index')
            ],
            [
                'title' => trans('basics::basics.create')
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
            'method' => 'POST',
            'button' => trans('helpers::action.create')
        ];
    }

    /* Edit */

    public function prepareBreadcrumbsEdit($title)
    {
        return [
            [
                'title' => trans_choice('basics.role', 2),
                'route' => route('roles.index')
            ],
            [
                'title' => $title #$role->name
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
            'method' => 'POST',
            'button' => trans('basics::basics.save')
        ];
    }
}
