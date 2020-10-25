<?php

namespace Izt\Basics\Http\Transformers;

use Illuminate\Support\Facades\View;
use Izt\Basics\Storage\Eloquent\Models\Country;
use League\Fractal\TransformerAbstract;

class CountryTransformer extends TransformerAbstract
{

    protected $defaultIncludes = ['state', 'updatedBy', 'deletedBy'];

    /**
     * @var null
     */
    private $list_type;

    /**
     * CountryTransformer constructor.
     * @param null $list_type
     */
    public function __construct($list_type = null)
    {
        $this->list_type = $list_type;
    }

    public function transform(Country $country = null)
    {
        if ($country === null) {
            return [
                'id' => 0,
                'name' => ''
            ];
        }

        $data = [
            'id' => $country->id,
            'name' => $country->name
        ];

        switch ($this->list_type) {
            case 'index':
                $data['actions'] = View::make('basics::layouts._table.partials._row_buttons_index',
                    [
                        'canEdit' => $country->canEdit(),
                        'canDelete' => $country->canDelete(),
                        'edit_route' => route('countrys.edit', $country->id),
                        'deactivate_route' => route('countrys.deactivate', $country->id),
                        'delete_route' => route('countrys.delete', $country->id)
                    ])->render();
                break;

            case 'trash':
                $data['deleted_at'] = getDataTime($country->deleted_at);
                $data['actions'] = View::make('basics::layouts._table.partials._row_buttons_trash',
                    [
                        'restore_route' => route('countrys.restore', $country->id),
                        'destroy_route' => route('countrys.destroy', $country->id)
                    ])->render();
                break;

            case 'nonactive':
                $data['updated_at'] = getDataTime($country->updated_at);
                $data['actions'] = View::make('basics::layouts._table.partials._row_buttons_nonactive',
                    ['active_route' => route('countrys.activate', $country->id)])->render();
                break;

            default:
                $data['actions'] = '';
                break;
        }

        return $data;
    }

    public function includeState(Country $country = null)
    {
        if ($country === null) {
            $state = null;
        } else {
            $state = $country->state;
        }

        return $this->item($state, new BaseTransformer());
    }

    public function includeUpdatedBy(Country $country = null)
    {
        if ($country === null) {
            $updatedBy = null;
        } else {
            $updatedBy = $country->updatedBy;
        }

        return $this->item($updatedBy, new BaseTransformer());
    }

    public function includeDeletedBy(Country $country = null)
    {
        if ($country === null) {
            $deletedBy = null;
        } else {
            $deletedBy = $country->deletedBy;
        }

        return $this->item($deletedBy, new BaseTransformer());
    }
}
