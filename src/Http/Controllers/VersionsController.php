<?php

namespace Izt\Basics\Http\Controllers;

use Izt\Basics\Http\Transformers\VersionTransformer;
use Izt\Basics\Storage\Interfaces\VersionRepositoryInterface;
use League\Fractal\Manager;
use League\Fractal\Resource\Collection;

class VersionsController extends Controller
{
    /**
     * @var VersionRepositoryInterface
     */
    private $repoVersion;
    /**
     * @var Manager
     */
    private $fractal;

    /**
     * VersionsController constructor.
     * @param VersionRepositoryInterface $repoVersion
     * @param Manager $fractal
     */
    public function __construct(
        VersionRepositoryInterface $repoVersion,
        Manager $fractal
    ) {

        $this->repoVersion = $repoVersion;
        $this->fractal = $fractal;
    }

    public function show()
    {
        $list_type = 'show';

        $versions = $this->repoVersion->allListed(['subversions'],
            ['id' => 'ASC'],
            ['main' => true]);

        $versionsCollection = new Collection($versions, new VersionTransformer($list_type));
        $versions = $this->fractal->createData($versionsCollection)->toArray();
        $versions = $versions['data'];

        $breadcrumbs = [
            [
                'title' => trans_choice('users.version', 2)
            ]
        ];

        $table_buttons = [

        ];

        return view('basics::Versions.show', compact('versions', 'breadcrumbs', 'table_buttons', 'list_type'));
    }

}
