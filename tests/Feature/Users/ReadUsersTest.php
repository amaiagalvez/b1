<?php

namespace Izt\Users\Tests\Feature\Users;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Izt\Users\Storage\Eloquent\Models\User;
use Izt\Users\Tests\TestCase;

class ReadUsersTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */

    public function user_index_load_ok()
    {
        $this->signIn();

        $this->get(route('users.index'))
            ->assertStatus(200);
    }

    /** @test */

    public function a_non_admin_user_cannot_load_user_index()
    {
        $this->signIn(null, "other");

        $this->get(route('users.index'))
            ->assertStatus(302)
            ->assertRedirect(route('front.home'));
    }

    /** @test */

    public function a_user_can_get_active_users_paginated()
    {
        $this->signIn();

        fCreate(User::class, ['active' => 1], 15);

        $response = $this->getJson(route('users.index',
            ['length' => 5, 'start' => 0, 'draw' => 0]));

        $this->assertCount(5, $response->json()['data']);

    }

    /** @test */

    public function a_user_can_see_active_users_in_index_route()
    {
        $this->signIn();

        $user_active = fCreate(User::class, ['active' => 1]);
        $user_not_active = fCreate(User::class, ['active' => 0]);

        $response = $this->getJson(route('users.index', ['length' => 10, 'start' => 0, 'draw' => 0]));

        $this->assertEquals($user_active->name, array_pop($response->json()['data'])['name']);
        $this->assertNotEquals($user_not_active->name, array_pop($response->json()['data'])['name']);

    }

    /** @test */

    public function a_user_cannot_see_not_active_users_in_index_route()
    {
        $this->signIn();

        $user_not_active = fCreate(User::class, ['active' => 0]);

        $response = $this->getJson(route('users.index', ['length' => 10, 'start' => 0, 'draw' => 0]));

        $this->assertNotEquals($user_not_active->name, array_pop($response->json()['data'])['name']);

    }

    /** @test */

    public function a_user_can_search_by_lang()
    {
        $this->signIn();

        $user_eu = fCreate(User::class, ['name' => 'aa 2. user name', 'lang' => 'eu', 'active' => 1]);

        $response = $this->getJson(route('users.index',
            ['search_lang' => 'eu']));

        $this->assertEquals($user_eu->name, array_pop($response->json()['data'])['name']);

        $user_es = fCreate(User::class, ['name' => 'aa 1. user name', 'lang' => 'es', 'active' => 1]);

        $response = $this->getJson(route('users.index',
            ['search_lang' => 'eu']));

        $this->assertNotEquals($user_es->name, array_pop($response->json()['data'])['name']);
    }

    /** @test */

    public function a_user_can_search_by_role_name()
    {
        $this->signIn();

        $user_eu = fCreate(User::class, ['name' => 'aa 2. user name', 'role_name' => 'admin', 'active' => 1]);

        $response = $this->getJson(route('users.index',
            ['search_role_name' => 'admin']));

        $this->assertEquals($user_eu->name, array_pop($response->json()['data'])['name']);

        $user_es = fCreate(User::class, ['name' => 'aa 1. user name', 'role_name' => 'user', 'active' => 1]);

        $response = $this->getJson(route('users.index',
            ['search_role_name' => 'admin']));

        $this->assertNotEquals($user_es->name, array_pop($response->json()['data'])['name']);
    }
}
