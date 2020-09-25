<?php

namespace Izt\Users;

use Config;
use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;
use Izt\Users\Http\Middleware\Admin;
use Izt\Users\Http\Middleware\Developer;
use Izt\Users\Http\Middleware\UserLanguage;
use Izt\Users\Providers\ComposerServiceProvider;
use Izt\Users\Storage\Eloquent\Repositories\MenuRepository;
use Izt\Users\Storage\Eloquent\Repositories\ModuleRepository;
use Izt\Users\Storage\Eloquent\Repositories\RoleRepository;
use Izt\Users\Storage\Eloquent\Repositories\SessionRepository;
use Izt\Users\Storage\Eloquent\Repositories\UserRepository;
use Izt\Users\Storage\Eloquent\Repositories\VariableRepository;
use Izt\Users\Storage\Eloquent\Repositories\VersionRepository;
use Izt\Users\Storage\Interfaces\MenuRepositoryInterface;
use Izt\Users\Storage\Interfaces\ModuleRepositoryInterface;
use Izt\Users\Storage\Interfaces\RoleRepositoryInterface;
use Izt\Users\Storage\Interfaces\SessionRepositoryInterface;
use Izt\Users\Storage\Interfaces\UserRepositoryInterface;
use Izt\Users\Storage\Interfaces\VariableRepositoryInterface;
use Izt\Users\Storage\Interfaces\VersionRepositoryInterface;
use Yajra\DataTables\DataTables;
use Yajra\DataTables\DataTablesServiceProvider;
use Yajra\DataTables\FractalServiceProvider;

class UsersServiceProvider extends ServiceProvider
{
    public function boot(Router $router)
    {
        Config::set('auth.providers.users.model', config('users.user'));

        $this->loadMigrationsFrom($this->basePath('database/migrations'));
        $this->loadFactoriesFrom($this->basePath('database/factories'));
        $this->loadViewsFrom($this->basePath('resources/views'), 'users');
        $this->loadTranslationsFrom($this->basePath('resources/lang'), 'users');

        $this->loadTranslationsFrom($this->basePath('/vendor/izt/helpers/resources/lang'), 'helpers');

        $router->middlewareGroup('admin', [Admin::class]);
        $router->middlewareGroup('developer', [Developer::class]);
        $router->middlewareGroup('userLang', [UserLanguage::class]);

        $this->publishes([
            $this->basePath('config/users.php') => base_path('config/users.php')
        ], 'izt-users-config');

        $this->publishes([
            $this->basePath('database/seeds') => base_path('database/seeds/vendor/users')
        ], 'izt-users-seeds');

        $this->publishes([
            $this->basePath('resources/lang') => resource_path('lang/vendor/users')
        ], 'izt-users-translations');
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

        //ModuleRepository
        $this->app->bind(
            ModuleRepositoryInterface::class,
            ModuleRepository::class
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

        $this->app->register(DataTablesServiceProvider::class);
        $this->app->register(FractalServiceProvider::class);
        $this->app->alias('datatables', DataTables::class);

        $this->mergeConfigFrom($this->basePath('config/users.php'), 'users');
    }

    protected function basePath($path)
    {
        return __DIR__ . '/../' . $path;
    }
}
