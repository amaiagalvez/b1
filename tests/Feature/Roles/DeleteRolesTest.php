<?php

namespace Izt\Basics\Tests\Feature\Roles;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Izt\Basics\Storage\Eloquent\Models\Role;
use Izt\Basics\Storage\Eloquent\Models\User;
use Izt\Basics\Tests\TestCase;

class DeleteRolesTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */

    public function role_trash_load_ok()
    {
        $this->signIn();

        $this->get(route('roles.trash'))
            ->assertStatus(200);
    }

    /** @test */

    public function a_non_admin_user_cannot_get_deleted_roles()
    {
        $this->signIn(null, "other");

        $this->get(route('roles.trash'))
            ->assertStatus(302)
            ->assertRedirect(route('front.home'));
    }

    /** @test */

    public function a_guest_cannot_get_deleted_roles()
    {

        $this->get(route('roles.trash'))
            ->assertStatus(302)
            ->assertRedirect(route('login'));
    }

    /** @test */

    public function a_user_can_get_deleted_roles_paginated()
    {
        $this->signIn();

        fCreate(Role::class, ['deleted_at' => '2020-01-01'], 15);

        $response = $this->getJson(route('roles.trash',
            ['length' => 5, 'start' => 0, 'draw' => 0]));

        $this->assertCount(5, $response->json()['data']);

    }

    /** @test */

    public function a_user_can_see_deleted_roles_in_trash_route()
    {
        $this->signIn();

        $role_deleted = fCreate(Role::class, ['deleted_at' => '2020-01-01']);
        $role_not_deleted = fCreate(Role::class);

        $response = $this->getJson(route('roles.trash', ['length' => 10, 'start' => 0, 'draw' => 0]));

        $this->assertEquals($role_deleted->name, array_pop($response->json()['data'])['name']);
        $this->assertNotEquals($role_not_deleted->name, array_pop($response->json()['data'])['name']);

    }

    /** @test */

    public function a_user_cannot_see_not_deleted_roles_in_trash_route()
    {
        $this->signIn();

        $role_not_deleted = fCreate(Role::class);

        $response = $this->getJson(route('roles.trash', ['length' => 10, 'start' => 0, 'draw' => 0]));

        $this->assertNotEquals($role_not_deleted->name, array_pop($response->json()['data'])['name']);

    }

    /** @test */

    public function a_user_can_delete_a_role_if_not_used()
    {
        $this->signIn();

        $role = fCreate(Role::class);

        $response = $this->from(route('roles.index'))
            ->post(route('roles.delete', $role->id))
            ->assertStatus(302)
            ->assertRedirect(route('roles.index'));

        $response->assertSessionHas('successMessage', trans('basics::action.delete_successfully'));

        $this->assertDatabaseMissing('APP_roles', [
            'id' => $role->id,
            'name' => $role->name,
            'deleted_at' => null
        ]);
    }

    /** @test */

    public function a_user_cannot_delete_a_role_if_used()
    {
        $this->signIn();

        $role = fCreate(Role::class);
        fCreate(User::class, ['role_name' => $role->name], 2);

        $response = $this->post(route('roles.delete', $role->id));

        $response->assertSessionHas('errorMessage', trans('basics::action.cannot_delete'));

        $this->assertDatabaseHas('APP_roles', [
            'id' => $role->id,
            'name' => $role->name,
            'deleted_at' => null
        ]);
    }

    /** @test */

    public function a_user_can_restore_a_deleted_role()
    {
        $this->signIn();

        $role = fCreate(Role::class, ['deleted_at' => '2020-01-01']);

        $response = $this->get(route('roles.restore', $role->id));

        $response->assertSessionHas('successMessage', trans('basics::action.restore_successfully'));

        $this->assertDatabaseHas('APP_roles', [
            'id' => $role->id,
            'name' => $role->name,
            'deleted_at' => null
        ]);
    }

    /** @test */

    public function a_user_can_force_delete_a_deleted_role()

    {
        $this->signIn();

        $role = fCreate(Role::class, ['deleted_at' => '2020-01-01']);

        $response = $this->post(route('roles.destroy', $role->id));

        $response->assertSessionHas('successMessage', trans('basics::action.delete_successfully'));

        $this->assertDatabaseMissing('APP_roles', [
            'id' => $role->id
        ]);
    }

    /** @test */

    public function a_user_cannot_delete_admin_role()
    {
        $this->signIn();

        $role = Role::where('name', 'admin')->first();

        $response = $this->post(route('roles.delete', $role->id));

        $response->assertStatus(403);
    }
}
