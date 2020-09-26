<?php

namespace Izt\Users;


use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends \Illuminate\Foundation\Support\Providers\RouteServiceProvider
{
    protected $namespace = "Izt\Basics\Http\Controllers";

    public function map()
    {
        Route::pattern('id', '\d+');

        Route::namespace($this->namespace)
            ->group(__DIR__ . '/../routes/web.php');

        $this->adminRoutes();

        $this->developerRoutes();
    }

    protected function adminRoutes()
    {
        Route::middleware(['web', 'auth', 'admin', 'userLang'])
            ->namespace($this->namespace)
            ->group(__DIR__ . '/../routes/_admin.php');
    }

    protected function developerRoutes()
    {
        Route::middleware(['web', 'auth', 'admin', 'userLang', 'developer'])
            ->prefix('dev')
            ->namespace($this->namespace)
            ->group(__DIR__ . '/../routes/_dev.php');
    }
}
