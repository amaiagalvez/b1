<?php

namespace Izt\Basics\Http\Controllers;

use Izt\Basics\Http\Transformers\VersionTransformer;
use Izt\Basics\Http\UIComponents\VersionComponents;
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

    public function index()
    {
        $list_type = 'index';

        $versions = $this->repoVersion->allListed(['application'],
            ['id' => 'ASC']);

        $versionsCollection = new Collection($versions, new VersionTransformer($list_type));
        $versions = $this->fractal->createData($versionsCollection)->toArray();
        $versions = $versions['data'];

        $buttonsGenerator = new VersionComponents();

        $breadcrumbs = $buttonsGenerator->prepareBreadcrumbsIndex();

        $table_buttons = $buttonsGenerator->prepareButtonsIndex();

        return view('basics::Versions.index', compact('versions', 'breadcrumbs', 'table_buttons', 'list_type'));
    }

}
