<?php

namespace Izt\Basics;

use Config;
use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;
use Izt\Basics\Http\Middleware\ActivityLogger;
use Izt\Basics\Http\Middleware\Admin;
use Izt\Basics\Http\Middleware\Developer;
use Izt\Basics\Http\Middleware\UserLanguage;
use Izt\Basics\Providers\ComposerServiceProvider;
use Izt\Basics\Providers\EventServiceProvider;
use Izt\Basics\Storage\Eloquent\Repositories\ApplicationRepository;
use Izt\Basics\Storage\Eloquent\Repositories\MenuRepository;
use Izt\Basics\Storage\Eloquent\Repositories\RoleRepository;
use Izt\Basics\Storage\Eloquent\Repositories\SessionRepository;
use Izt\Basics\Storage\Eloquent\Repositories\UserRepository;
use Izt\Basics\Storage\Eloquent\Repositories\VariableRepository;
use Izt\Basics\Storage\Eloquent\Repositories\VersionRepository;
use Izt\Basics\Storage\Interfaces\ApplicationRepositoryInterface;
use Izt\Basics\Storage\Interfaces\MenuRepositoryInterface;
use Izt\Basics\Storage\Interfaces\RoleRepositoryInterface;
use Izt\Basics\Storage\Interfaces\SessionRepositoryInterface;
use Izt\Basics\Storage\Interfaces\UserRepositoryInterface;
use Izt\Basics\Storage\Interfaces\VariableRepositoryInterface;
use Izt\Basics\Storage\Interfaces\VersionRepositoryInterface;
use Yajra\DataTables\DataTablesServiceProvider;
use Yajra\DataTables\FractalServiceProvider;

class BasicsServiceProvider extends ServiceProvider
{
    public function boot(Router $router)
    {
        Config::set('auth.providers.users.model', config('helpers.user'));

        $this->loadMigrationsFrom($this->basePath('database/migrations'));
        $this->loadFactoriesFrom($this->basePath('database/factories'));

        $this->loadViewsFrom($this->basePath('resources/views'), 'basics');
        $this->loadViewsFrom($this->basePath('/vendor/izt/helpers/resources/views'), 'helpers');

        $this->loadTranslationsFrom($this->basePath('resources/lang'), 'basics');
        $this->loadTranslationsFrom($this->basePath('/vendor/izt/helpers/resources/lang'), 'helpers');

        $router->middlewareGroup('admin', [Admin::class]);
        $router->middlewareGroup('developer', [Developer::class]);
        $router->middlewareGroup('userLang', [UserLanguage::class]);
        $router->middlewareGroup('activityLog', [ActivityLogger::class]);

        $this->publishes([
            $this->basePath('config/basics.php') => base_path('config/basics.php')
        ], 'izt-basics-config');

        $this->publishes([
            $this->basePath('resources/assets') => base_path('public/basics')
        ], 'izt-basics-assets');

        $this->publishes([
            $this->basePath('database/seeds') => base_path('database/seeds')
        ], 'izt-basics-seeds');
    }

    public function register()
    {
        //VariableRepository
        $this->app->bind(
            VariableRepositoryInterface::class,
            VariableRepository::class
        );

        //UserRepository
        $this->app->bind(
            UserRepositoryInterface::class,
            UserRepository::class
        );

        //SessionRepository
        $this->app->bind(
            SessionRepositoryInterface::class,
            SessionRepository::class
        );

        //RoleRepository
        $this->app->bind(
            RoleRepositoryInterface::class,
            RoleRepository::class
        );

        //ApplicationRepository
        $this->app->bind(
            ApplicationRepositoryInterface::class,
            ApplicationRepository::class
        );

        //MenuRepository
        $this->app->bind(
            MenuRepositoryInterface::class,
            MenuRepository::class
        );

        //VersionRepository
        $this->app->bind(
            VersionRepositoryInterface::class,
            VersionRepository::class
        );

        $this->app->register(ComposerServiceProvider::class);
        $this->app->register(EventServiceProvider::class);

        $this->app->register(DataTablesServiceProvider::class);
        $this->app->register(FractalServiceProvider::class);

        $this->mergeConfigFrom($this->basePath('config/basics.php'), 'basics');
        $this->mergeConfigFrom($this->basePath('config/helpers.php'), 'helpers');
    }

    protected function basePath($path)
    {
        return __DIR__ . '/../' . $path;
    }
}
