<?php

namespace Izt\Basics\Tests;

use Izt\Basics\BasicsServiceProvider;
use Izt\Basics\RouteServiceProvider;
use Izt\Basics\Storage\Eloquent\Models\User;

abstract class TestCase extends \Orchestra\Testbench\TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        $this->seed('BasicsDatabaseSeeder');
    }

    protected function getEnvironmentSetUp($app)
    {
        testEnviroment($app);
    }

    protected function getPackageProviders($app)
    {
        return [
            BasicsServiceProvider::class,
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
