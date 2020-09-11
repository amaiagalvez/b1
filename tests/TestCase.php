<?php

namespace Izt\Users\Tests;

use Illuminate\Routing\Middleware\ThrottleRequests;
use Illuminate\Support\Facades\DB;
use Izt\Users\RouteServiceProvider;
use Izt\Users\Storage\Eloquent\Models\Role;
use Izt\Users\Storage\Eloquent\Models\User;
use Izt\Users\UsersServiceProvider;

abstract class TestCase extends \Orchestra\Testbench\TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->runDatabaseMigrations();

        $this->withoutMiddleware(
            ThrottleRequests::class
        );

        DB::beginTransaction();

        if (method_exists($this, 'runDatabaseMigrations')) {

            $this->signIn();
        }
    }

    protected function signIn($user = null)
    {
        $user = $user ?: create(User::class, [
            'lang' => 'eu',
            'role_name' => 'admin',
            'active' => 1
        ]);

        $this->actingAs($user);

        return $this;
    }

    protected function tearDown(): void
    {
        DB::rollback();

        parent::tearDown();
    }

    public function runDatabaseMigrations()
    {
        $this->artisan('migrate:fresh');
        $this->artisan('db:seed');
    }

    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('database.default', 'testing');
        $app['config']->set('database.connection.testing', [
            'driver' => 'sqlite',
            'database' => ':memory:'
        ]);

        $this->app->artisan('migrate:fresh');
        $this->app->artisan('db:seed');
    }


    protected function getPackageProviders($app)
    {
        return [
            UsersServiceProvider::class,
            RouteServiceProvider::class
        ];
    }

    protected function getPackageAliases($app)
    {
        return [
            'DataBaseSeeder' => DatabaseSeeder::class,
            'Role' => Role::class,
            'User' => User::class
        ];
    }
}
