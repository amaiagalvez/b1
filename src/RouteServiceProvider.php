<?php

namespace Izt\Basics;

use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends \Illuminate\Foundation\Support\Providers\RouteServiceProvider
{
    protected $namespace = "Izt\Basics\Http\Controllers";

    public function map()
    {
        Route::pattern('id', '\d+');

        Route::namespace($this->namespace)
            ->group(__DIR__ . '/../routes/web.php');

        $this->appRoutes();

        $this->developerRoutes();

        $this->locRoutes();
    }

    protected function appRoutes()
    {
        Route::middleware(['web', 'auth', 'userLang', 'admin'])
            ->namespace($this->namespace)
            ->group(__DIR__ . '/../routes/_app.php');
    }

    protected function locRoutes()
    {
        Route::middleware(['web', 'auth', 'userLang', 'admin'])
            ->namespace($this->namespace)
            ->group(__DIR__ . '/../routes/_loc.php');
    }

    protected function developerRoutes()
    {
        Route::middleware(['web', 'auth', 'userLang', 'developer'])
            ->prefix('dev')
            ->namespace($this->namespace)
            ->group(__DIR__ . '/../routes/_dev.php');
    }
}
