<?php

namespace Izt\Basics\Http\Transformers;

use Illuminate\Support\Facades\View;
use Izt\Basics\Storage\Eloquent\Models\District;
use League\Fractal\TransformerAbstract;

class DistrictTransformer extends TransformerAbstract
{

    protected $defaultIncludes = ['country', 'updatedBy', 'deletedBy'];

    /**
     * @var null
     */
    private $list_type;

    /**
     * DistrictTransformer constructor.
     * @param null $list_type
     */
    public function __construct($list_type = null)
    {
        $this->list_type = $list_type;
    }

    public function transform(District $district = null)
    {
        if ($district === null) {
            return [
                'id' => 0,
                'name' => ''
            ];
        }

        $data = [
            'id' => $district->id,
            'name' => $district->name
        ];

        switch ($this->list_type) {
            case 'index':
                $data['actions'] = View::make('basics::layouts._table.partials._row_buttons_index',
                    [
                        'canEdit' => $district->canEdit(),
                        'canDelete' => $district->canDelete(),
                        'edit_route' => route('districts.edit', $district->id),
                        'deactivate_route' => route('districts.deactivate', $district->id),
                        'delete_route' => route('districts.delete', $district->id)
                    ])->render();
                break;

            case 'trash':
                $data['deleted_at'] = getDataTime($district->deleted_at);
                $data['actions'] = View::make('basics::layouts._table.partials._row_buttons_trash',
                    [
                        'restore_route' => route('districts.restore', $district->id),
                        'destroy_route' => route('districts.destroy', $district->id)
                    ])->render();
                break;

            case 'nonactive':
                $data['updated_at'] = getDataTime($district->updated_at);
                $data['actions'] = View::make('basics::layouts._table.partials._row_buttons_nonactive',
                    ['active_route' => route('districts.activate', $district->id)])->render();
                break;

            default:
                $data['actions'] = '';
                break;
        }

        return $data;
    }

    public function includeCountry(District $district = null)
    {
        if ($district === null) {
            $country = null;
        } else {
            $country = $district->country;
        }

        return $this->item($country, new CountryTransformer());
    }

    public function includeUpdatedBy(District $district = null)
    {
        if ($district === null) {
            $updatedBy = null;
        } else {
            $updatedBy = $district->updatedBy;
        }

        return $this->item($updatedBy, new BaseTransformer());
    }

    public function includeDeletedBy(District $district = null)
    {
        if ($district === null) {
            $deletedBy = null;
        } else {
            $deletedBy = $district->deletedBy;
        }

        return $this->item($deletedBy, new BaseTransformer());
    }
}
