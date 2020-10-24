<?php namespace Izt\Basics\ViewComposers;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Cache;
use Izt\Basics\Storage\Interfaces\VariableRepositoryInterface;

class VariableComposer
{
    /**
     * @var VariableRepositoryInterface
     */
    private $repoVariable;

    /**
     * AdminComposer constructor.
     * @param VariableRepositoryInterface $repoVariable
     */
    public function __construct(
        VariableRepositoryInterface $repoVariable
    ) {
        $this->repoVariable = $repoVariable;
    }

    /**
     * @param View $view
     * @return View
     */
    public function compose(View $view)
    {

        $languages = Cache::remember('languages', 1440, function () {

            return getArray($this->repoVariable->getValueByName('lang'));

        });

        $app_name = Cache::remember('app_name', 1440, function () {

            return $this->repoVariable->getValueByName('name');

        });

        return $view->with('languages', $languages)
            ->with('app_name', $app_name);

    }
}
