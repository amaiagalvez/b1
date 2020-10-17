<?php

namespace Izt\Basics\Http\Transformers;

use Izt\Basics\Storage\Eloquent\Models\Application;
use League\Fractal\TransformerAbstract;

class ApplicationTransformer extends TransformerAbstract
{

    protected $defaultIncludes = [];

    /**
     * ApplicationTransformer constructor.
     */
    public function __construct()
    {

    }

    public function transform(Application $application = null)
    {
        if ($application === null) {
            return [];
        }

        return [
            'id' => $application->id,
            'title' => $application->present()->title,
            'notes' => $application->present()->notes
        ];
    }
}
