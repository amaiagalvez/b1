<?php

namespace Izt\Users;


use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends \Illuminate\Foundation\Support\Providers\RouteServiceProvider
{
    protected $namespace = "Izt\Users\Http\Controllers";

    public function map()
    {
        Route::namespace($this->namespace)
            ->group(__DIR__ . '/../routes/web.php');

        $this->adminRoutes();

        $this->developerRoutes();
    }

    protected function adminRoutes()
    {
        Route::middleware(['web', 'auth', 'admin', 'userLanguage'])
            ->prefix('admin')
            ->namespace($this->namespace)
            ->group(__DIR__ . '/../routes/_admin.php');
    }

    protected function developerRoutes()
    {
        Route::middleware(['web', 'auth', 'admin', 'userLanguage', 'developer'])
            ->prefix('dev')
            ->namespace($this->namespace)
            ->group(__DIR__ . '/../routes/_dev.php');
    }
}
