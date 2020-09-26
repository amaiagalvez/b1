<?php

namespace Izt\Basics\Http\Transformers;

use Illuminate\Support\Facades\View;
use Izt\Basics\Classes\FieldTypes;
use Izt\Basics\Storage\Eloquent\Models\Variable;
use League\Fractal\TransformerAbstract;

class VariableTransformer extends TransformerAbstract
{

    protected $defaultIncludes = [];
    /**
     * @var null
     */
    private $list_type;

    /**
     * VariableTransformer constructor.
     * @param null $list_type
     */
    public function __construct($list_type = null)
    {

        $this->list_type = $list_type;
    }

    public function transform(Variable $variable = null)
    {
        if ($variable === null) {
            return [];
        }

        $data = [
            'id' => $variable->id,
            $variable->present()->FieldName('title') => $variable->present()->title,
            'value' => $variable->value,
            $variable->present()->FieldName('notes') => $variable->present()->notes,
            'order' => $variable->order
        ];

        switch ($variable->filed_type) {
            case FieldTypes::IMAGE:
                $data['value'] = '<img id="value" src="' . asset('images/' . $variable->value) . '" width="75px" height="auto" alt="' . env('APP_NAME',
                        '') . '">';
                break;
            case  FieldTypes::BOOLEAN:
                $data['value'] = ok_ko_format($variable->value);
                break;

//            case FieldTypes::LONGTEXT:
//                $data['value'] = html_entity_decode(e($variable->value));
//                break;

            case  FieldTypes::NUMBER:
                $data['value'] = label($variable->value);
                break;

            case FieldTypes::LIST:
                $data['value'] = mb_strtoupper(getList($variable->value));
                break;
        }

        $data['actions'] = '';

        if ($this->list_type === 'index') {
            $data['actions'] = View::make('basics::Variables.partials._row_buttons_index',
                compact('variable'))->render();
        }

        return $data;
    }

}
