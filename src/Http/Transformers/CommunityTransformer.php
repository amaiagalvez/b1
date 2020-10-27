<?php

namespace Izt\Basics\Http\Transformers;

use Illuminate\Support\Facades\View;
use Izt\Basics\Storage\Eloquent\Models\Community;
use League\Fractal\TransformerAbstract;

class CommunityTransformer extends TransformerAbstract
{

    protected $defaultIncludes = ['updatedBy', 'deletedBy'];

    /**
     * @var null
     */
    private $list_type;

    /**
     * CommunityTransformer constructor.
     * @param null $list_type
     */
    public function __construct($list_type = null)
    {
        $this->list_type = $list_type;
    }

    public function transform(Community $community = null)
    {
        if ($community === null) {
            return [
                'id' => 0,
                'name' => ''
            ];
        }

        $data = [
            'id' => $community->id,
            'name' => $community->name
        ];

        switch ($this->list_type) {
            case 'index':
                $data['actions'] = View::make('basics::layouts._table.partials._row_buttons_index',
                    [
                        'canEdit' => $community->canEdit(),
                        'canDelete' => $community->canDelete(),
                        'edit_route' => route('communities.edit', $community->id),
                        'deactivate_route' => route('communities.deactivate', $community->id),
                        'delete_route' => route('communities.delete', $community->id)
                    ])->render();
                break;

            case 'trash':
                $data['deleted_at'] = getDataTime($community->deleted_at);
                $data['actions'] = View::make('basics::layouts._table.partials._row_buttons_trash',
                    [
                        'restore_route' => route('communities.restore', $community->id),
                        'destroy_route' => route('communities.destroy', $community->id)
                    ])->render();
                break;

            case 'nonactive':
                $data['updated_at'] = getDataTime($community->updated_at);
                $data['actions'] = View::make('basics::layouts._table.partials._row_buttons_nonactive',
                    ['active_route' => route('communities.activate', $community->id)])->render();
                break;

            default:
                $data['actions'] = '';
                break;
        }

        return $data;
    }

    public function includeUpdatedBy(Community $community = null)
    {
        if ($community === null) {
            $updatedBy = null;
        } else {
            $updatedBy = $community->updatedBy;
        }

        return $this->item($updatedBy, new BaseTransformer());
    }

    public function includeDeletedBy(Community $community = null)
    {
        if ($community === null) {
            $deletedBy = null;
        } else {
            $deletedBy = $community->deletedBy;
        }

        return $this->item($deletedBy, new BaseTransformer());
    }
}
