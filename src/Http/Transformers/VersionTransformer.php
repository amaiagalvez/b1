<?php

namespace Izt\Basics\Http\Transformers;

use Izt\Basics\Storage\Eloquent\Models\Version;
use League\Fractal\TransformerAbstract;

class VersionTransformer extends TransformerAbstract
{

    protected $defaultIncludes = ['application'];

    /**
     * @var null
     */
    private $list_type;

    /**
     * VersionTransformer constructor.
     * @param null $list_type
     */
    public function __construct($list_type = null)
    {
        $this->list_type = $list_type;
    }

    public function transform(Version $version = null)
    {
        if ($version === null) {
            return [];
        }

        return [
            'id' => $version->id,
            'name' => 'v.' . $version->name,
            $version->present()->FieldName('notes') => $version->present()->notes,
            'notes' => $version->present()->notes,
            'created_at' => date('Y-m-d', strtotime($version->created_at)),
            'actions' => ''
        ];

    }


    public function includeApplication(Version $version = null)
    {
        if ($version === null) {
            $application = null;
        } else {
            $application = $version->application;
        }

        return $this->item($application, new ApplicationTransformer());
    }

}
