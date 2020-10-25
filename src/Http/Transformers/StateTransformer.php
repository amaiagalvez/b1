<?php

namespace Izt\Basics\Http\Transformers;

use Illuminate\Support\Facades\View;
use Izt\Basics\Storage\Eloquent\Models\State;
use League\Fractal\TransformerAbstract;

class StateTransformer extends TransformerAbstract
{

    protected $defaultIncludes = ['updatedBy', 'deletedBy'];

    /**
     * @var null
     */
    private $list_type;

    /**
     * StateTransformer constructor.
     * @param null $list_type
     */
    public function __construct($list_type = null)
    {
        $this->list_type = $list_type;
    }

    public function transform(State $state = null)
    {
        if ($state === null) {
            return [
                'id' => 0,
                'name' => ''
            ];
        }

        $data = [
            'id' => $state->id,
            'name' => $state->name
        ];

        switch ($this->list_type) {
            case 'index':
                $data['actions'] = View::make('basics::layouts._table.partials._row_buttons_index',
                    [
                        'canEdit' => $state->canEdit(),
                        'canDelete' => $state->canDelete(),
                        'edit_route' => route('states.edit', $state->id),
                        'deactivate_route' => route('states.deactivate', $state->id),
                        'delete_route' => route('states.delete', $state->id)
                    ])->render();
                break;

            case 'trash':
                $data['deleted_at'] = getDataTime($state->deleted_at);
                $data['actions'] = View::make('basics::layouts._table.partials._row_buttons_trash',
                    [
                        'restore_route' => route('states.restore', $state->id),
                        'destroy_route' => route('states.destroy', $state->id)
                    ])->render();
                break;

            case 'nonactive':
                $data['updated_at'] = getDataTime($state->updated_at);
                $data['actions'] = View::make('basics::layouts._table.partials._row_buttons_nonactive',
                    ['active_route' => route('states.activate', $state->id)])->render();
                break;

            default:
                $data['actions'] = '';
                break;
        }

        return $data;
    }

    public function includeUpdatedBy(State $state = null)
    {
        if ($state === null) {
            $updatedBy = null;
        } else {
            $updatedBy = $state->updatedBy;
        }

        return $this->item($updatedBy, new BaseTransformer());
    }

    public function includeDeletedBy(State $state = null)
    {
        if ($state === null) {
            $deletedBy = null;
        } else {
            $deletedBy = $state->deletedBy;
        }

        return $this->item($deletedBy, new BaseTransformer());
    }
}
