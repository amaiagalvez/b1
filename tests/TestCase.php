<?php

namespace Izt\Basics\Tests;

use Izt\Basics\RouteServiceProvider;
use Izt\Basics\Storage\Eloquent\Models\User;
use Izt\Basics\UsersServiceProvider;

abstract class TestCase extends \Orchestra\Testbench\TestCase
{
    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('database.default', 'testing');
        $app['config']->set('database.connection.testing', [
            'driver' => 'sqlite',
            'database' => ':memory:'
        ]);
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

        ];
    }

    protected function assertClassUsesTrait($trait, $class)
    {
        return $this->assertArrayHasKey(
            $trait,
            class_uses($class),
            "{$class} must use the {$trait} trait."
        );
    }

    protected function signIn($user = null, $role = 'admin')
    {
        $user = $user ?: fCreate(User::class, [
            'lang' => 'en',
            'role_name' => $role,
            'active' => 1
        ]);

        $this->actingAs($user);

        return $this;
    }
}
