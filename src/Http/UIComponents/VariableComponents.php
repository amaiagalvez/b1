<?php

namespace Izt\Basics\Http\UIComponents;

class VariableComponents
{

    /* Index */

    public function prepareBreadcrumbsIndex()
    {
        return [
            [
                'title' => trans_choice('basics::basics.variable', 2)
            ]
        ];
    }

    public function prepareButtonsIndex()
    {
        return [];
    }

    /* Edit */

    public function prepareBreadcrumbsEdit($title)
    {
        return [
            [
                'title' => trans_choice('basics::basics.variable', 2),
                'route' => route('variables.index')
            ],
            [
                'title' => $title
            ]
        ];
    }

    public function prepareButtonsEdit()
    {
        return [
            'partial_route' => 'variables',
            'list' => true
        ];
    }

    public function prepareFormEdit($id)
    {
        return [
            'action' => route('variables.update', $id),
            'button' => trans('basics::action.save')
        ];
    }
}
