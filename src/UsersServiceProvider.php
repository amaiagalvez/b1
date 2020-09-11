<?php

namespace Izt\Users;

use Illuminate\Support\ServiceProvider;
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

class UsersServiceProvider extends ServiceProvider
{
    public function boot() {
        $this->loadMigrationsFrom($this->basePath('database/migrations'));
        $this->loadFactoriesFrom($this->basePath('database/factories'));

        $this->publishes([
            $this->basePath('config/users.php') => base_path('config/users.php')
        ], 'izt-users-config');

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

        $this->mergeConfigFrom($this->basePath('config/users.php'), 'users');
    }

    protected function basePath($path) {
        return __DIR__.'/../'.$path;
    }
}
