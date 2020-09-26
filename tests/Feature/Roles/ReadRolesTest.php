<?php

namespace Izt\Basics\Tests\Feature\Roles;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Izt\Basics\Storage\Eloquent\Models\Role;
use Izt\Basics\Tests\TestCase;

class ReadRolesTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */

    public function role_index_load_ok()
    {
        $this->signIn();

        $this->get(route('roles.index'))
            ->assertStatus(200);
    }

    /** @test */

    public function a_non_admin_user_cannot_load_role_index()
    {
        $this->signIn(null, "other");

        $this->markTestIncomplete();

        $this->get(route('roles.index'))
            ->assertStatus(302)
            ->assertRedirect(route('front.home'));
    }

    /** @test */

    public function a_user_can_get_roles_paginated()
    {
        $this->signIn();

        fCreate(Role::class, [], 15);

        $response = $this->getJson(route('roles.index',
            ['length' => 5, 'start' => 0, 'draw' => 0]));

        $this->assertCount(5, $response->json()['data']);

    }

    /** @test */

    public function a_user_can_see_roles_in_index_route()
    {
        $this->signIn();

        $role = fCreate(Role::class, ['name' => 'role name']);

        $response = $this->getJson(route('roles.index', ['length' => 10, 'start' => 0, 'draw' => 0]));

        $this->assertEquals($role->name, array_pop($response->json()['data'])['name']);

    }
}
