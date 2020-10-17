<?php namespace Izt\Basics\ViewComposers;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Cache;
use Izt\Basics\Http\Transformers\ApplicationTransformer;
use Izt\Basics\Storage\Interfaces\ApplicationRepositoryInterface;
use Izt\Basics\Storage\Interfaces\MenuRepositoryInterface;
use League\Fractal\Manager;
use League\Fractal\Resource\Collection;

class MenuComposer
{
    /**
     * @var MenuRepositoryInterface
     */
    private $repoMenu;
    /**
     * @var Manager
     */
    private $fractal;
    /**
     * @var ApplicationRepositoryInterface
     */
    private $repoApp;

    /**
     * MenuComposer constructor.
     * @param MenuRepositoryInterface $repoMenu
     * @param ApplicationRepositoryInterface $repoApp
     * @param Manager $fractal
     */
    public function __construct(
        MenuRepositoryInterface $repoMenu,
        ApplicationRepositoryInterface $repoApp,
        Manager $fractal
    ) {
        $this->repoMenu = $repoMenu;
        $this->fractal = $fractal;
        $this->repoApp = $repoApp;
    }

    /**
     * @param View $view
     * @return View
     */
    public function compose(View $view)
    {
        //Cache::flush(); //TODO: kendu hau

        $menus = Cache::remember('menus', 1440, function () {

            return $this->repoMenu->allListed(['submenus'],
                ['order' => 'ASC'],
                ['active' => 1, 'main' => true]);

        });

        $applications = Cache::remember('applications', 1440, function () {

            $apps = $this->repoApp->allListed(null,
                ['order' => 'ASC']);

            $appsCollection = new Collection($apps, new ApplicationTransformer());
            $apps = $this->fractal->createData($appsCollection)->toArray();
            return $apps['data'];
        });

        return $view->with('menus', $menus)
            ->with('applications', $applications);

    }
}
