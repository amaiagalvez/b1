<?php

namespace Izt\Basics;

use Config;
use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;
use Izt\Basics\Http\Middleware\ActivityLogger;
use Izt\Basics\Http\Middleware\Admin;
use Izt\Basics\Http\Middleware\Developer;
use Izt\Basics\Http\Middleware\UserLanguage;
use Izt\Basics\Providers\BladeServiceProvider;
use Izt\Basics\Providers\ComposerServiceProvider;
use Izt\Basics\Providers\EventServiceProvider;
use Izt\Basics\Storage\Eloquent\Repositories\ApplicationRepository;
use Izt\Basics\Storage\Eloquent\Repositories\AreaRepository;
use Izt\Basics\Storage\Eloquent\Repositories\CountryRepository;
use Izt\Basics\Storage\Eloquent\Repositories\DistrictRepository;
use Izt\Basics\Storage\Eloquent\Repositories\MenuRepository;
use Izt\Basics\Storage\Eloquent\Repositories\NeighborhoodRepository;
use Izt\Basics\Storage\Eloquent\Repositories\PostalCodeRepository;
use Izt\Basics\Storage\Eloquent\Repositories\RoleRepository;
use Izt\Basics\Storage\Eloquent\Repositories\SessionRepository;
use Izt\Basics\Storage\Eloquent\Repositories\StateRepository;
use Izt\Basics\Storage\Eloquent\Repositories\TownRepository;
use Izt\Basics\Storage\Eloquent\Repositories\UserRepository;
use Izt\Basics\Storage\Eloquent\Repositories\VariableRepository;
use Izt\Basics\Storage\Eloquent\Repositories\VersionRepository;
use Izt\Basics\Storage\Interfaces\ApplicationRepositoryInterface;
use Izt\Basics\Storage\Interfaces\AreaRepositoryInterface;
use Izt\Basics\Storage\Interfaces\CountryRepositoryInterface;
use Izt\Basics\Storage\Interfaces\DistrictRepositoryInterface;
use Izt\Basics\Storage\Interfaces\MenuRepositoryInterface;
use Izt\Basics\Storage\Interfaces\NeighborhoodRepositoryInterface;
use Izt\Basics\Storage\Interfaces\PostalCodeRepositoryInterface;
use Izt\Basics\Storage\Interfaces\RoleRepositoryInterface;
use Izt\Basics\Storage\Interfaces\SessionRepositoryInterface;
use Izt\Basics\Storage\Interfaces\StateRepositoryInterface;
use Izt\Basics\Storage\Interfaces\TownRepositoryInterface;
use Izt\Basics\Storage\Interfaces\UserRepositoryInterface;
use Izt\Basics\Storage\Interfaces\VariableRepositoryInterface;
use Izt\Basics\Storage\Interfaces\VersionRepositoryInterface;
use Yajra\DataTables\DataTablesServiceProvider;
use Yajra\DataTables\FractalServiceProvider;

class BasicsServiceProvider extends ServiceProvider
{
    public function boot(Router $router)
    {
        Config::set('auth.providers.users.model', config('basics.user'));

        $this->loadMigrationsFrom($this->basePath('database/migrations'));
        $this->loadFactoriesFrom($this->basePath('database/factories'));

        $this->loadViewsFrom($this->basePath('resources/views'), 'basics');

        $this->loadTranslationsFrom($this->basePath('resources/lang'), 'basics');

        $router->middlewareGroup('admin', [Admin::class]);
        $router->middlewareGroup('developer', [Developer::class]);
        $router->middlewareGroup('userLang', [UserLanguage::class]);
        $router->middlewareGroup('activityLog', [ActivityLogger::class]);

        /* Config */

        $this->publishes([
            $this->basePath('config/basics.php') => base_path('config/basics.php')
        ], 'izt-basics-config');

        /* Assets */

        $this->publishes([
            $this->basePath('public') => base_path('resources/assets/basics')
        ], 'izt-basics-assets');

        /* Lang */

        $this->publishes([
            $this->basePath('resources/lang') => base_path('resources/lang')
        ], 'izt-basics-lang');

        /* Views */

        $this->publishes([
            $this->basePath('resources/views/layouts') => base_path('resources/views/layouts')
        ], 'izt-basics-layouts');

        /* Help */

        $this->publishes([
            $this->basePath('help/Exceptions') => base_path('app/Exceptions')
        ], 'izt-basics-zhelp-exceptions');

        $this->publishes([
            $this->basePath('help/config') => base_path('config')
        ], 'izt-basics-zhelp-config');

        $this->publishes([
            $this->basePath('help/routes') => base_path('app/routes')
        ], 'izt-basics-zhelp-routes');

        $this->publishes([
            $this->basePath('help/app/Http') => base_path('app/Http')
        ], 'izt-basics-zhelp-app-http');

        $this->publishes([
            $this->basePath('help/app/Providers') => base_path('app/Providers')
        ], 'izt-basics-zhelp-app-providers');

        $this->publishes([
            $this->basePath('help/tests') => base_path('tests')
        ], 'izt-basics-zhelp-tests');

        $this->publishes([
            $this->basePath('help/home') => base_path('')
        ], 'izt-basics-zhelp-home');
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

        //StateRepository
        $this->app->bind(
            StateRepositoryInterface::class,
            StateRepository::class
        );

        //CountryRepository
        $this->app->bind(
            CountryRepositoryInterface::class,
            CountryRepository::class
        );

        //DistrictRepository
        $this->app->bind(
            DistrictRepositoryInterface::class,
            DistrictRepository::class
        );

        //TownRepository
        $this->app->bind(
            TownRepositoryInterface::class,
            TownRepository::class
        );

        //NeighborhoodRepository
        $this->app->bind(
            NeighborhoodRepositoryInterface::class,
            NeighborhoodRepository::class
        );

        //AreaRepository
        $this->app->bind(
            AreaRepositoryInterface::class,
            AreaRepository::class
        );

        //PostalCodeRepository
        $this->app->bind(
            PostalCodeRepositoryInterface::class,
            PostalCodeRepository::class
        );

        $this->app->register(ComposerServiceProvider::class);
        $this->app->register(EventServiceProvider::class);
        $this->app->register(BladeServiceProvider::class);

        $this->app->register(DataTablesServiceProvider::class);
        $this->app->register(FractalServiceProvider::class);

        $this->mergeConfigFrom($this->basePath('config/basics.php'), 'basics');
    }

    protected function basePath($path)
    {
        return str_replace('src', '', __DIR__) . '' . $path;
    }
}
