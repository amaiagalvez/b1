<?php

namespace Izt\Basics\Http\Transformers;

use Illuminate\Support\Facades\View;
use Izt\Basics\Storage\Eloquent\Models\Town;
use League\Fractal\TransformerAbstract;

class TownTransformer extends TransformerAbstract
{

    protected $defaultIncludes = ['district', 'updatedBy', 'deletedBy'];

    /**
     * @var null
     */
    private $list_type;

    /**
     * TownTransformer constructor.
     * @param null $list_type
     */
    public function __construct($list_type = null)
    {
        $this->list_type = $list_type;
    }

    public function transform(Town $town = null)
    {
        if ($town === null) {
            return [
                'id' => 0,
                'name' => ''
            ];
        }

        $data = [
            'id' => $town->id,
            'name' => $town->name
        ];

        switch ($this->list_type) {
            case 'index':
                $data['actions'] = View::make('basics::layouts._table.partials._row_buttons_index',
                    [
                        'canEdit' => $town->canEdit(),
                        'canDelete' => $town->canDelete(),
                        'edit_route' => route('towns.edit', $town->id),
                        'deactivate_route' => route('towns.deactivate', $town->id),
                        'delete_route' => route('towns.delete', $town->id)
                    ])->render();
                break;

            case 'trash':
                $data['deleted_at'] = getDataTime($town->deleted_at);
                $data['actions'] = View::make('basics::layouts._table.partials._row_buttons_trash',
                    [
                        'restore_route' => route('towns.restore', $town->id),
                        'destroy_route' => route('towns.destroy', $town->id)
                    ])->render();
                break;

            case 'nonactive':
                $data['updated_at'] = getDataTime($town->updated_at);
                $data['actions'] = View::make('basics::layouts._table.partials._row_buttons_nonactive',
                    ['active_route' => route('towns.activate', $town->id)])->render();
                break;

            default:
                $data['actions'] = '';
                break;
        }

        return $data;
    }

    public function includeDistrict(Town $town = null)
    {
        if ($town === null) {
            $district = null;
        } else {
            $district = $town->district;
        }

        return $this->item($district, new DistrictTransformer());
    }

    public function includeUpdatedBy(Town $town = null)
    {
        if ($town === null) {
            $updatedBy = null;
        } else {
            $updatedBy = $town->updatedBy;
        }

        return $this->item($updatedBy, new BaseTransformer());
    }

    public function includeDeletedBy(Town $town = null)
    {
        if ($town === null) {
            $deletedBy = null;
        } else {
            $deletedBy = $town->deletedBy;
        }

        return $this->item($deletedBy, new BaseTransformer());
    }
}
