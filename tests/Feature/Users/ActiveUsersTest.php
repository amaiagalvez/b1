<?php

namespace Izt\Users\Tests\Feature\Users;

use Auth;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Izt\Users\Storage\Eloquent\Models\Role;
use Izt\Users\Storage\Eloquent\Models\User;
use Izt\Users\Tests\TestCase;


class ActiveUsersTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */

    public function user_nonactive_load_ok()
    {
        $this->signIn();

        fCreate(Role::class, ['name' => 'admin']);

        $this->get(route('users.nonactive'))
            ->assertStatus(200);
    }

    public function a_non_admin_user_cannot_list_nonactive_users()
    {
        $this->signIn();

        $user = fCreate(User::class, ['active' => 1, 'role_name' => 'web']);
        $this->actingAs($user);

        $this->get(route('users.nonactive.create'))
            ->assertStatus(302)
            ->assertRedirect(route('front.home'));
    }

    /** @test */

    public function a_user_can_get_nonactive_users_paginated()
    {
        $this->signIn();

        fCreate(Role::class, ['name' => 'admin']);

        fCreate(User::class, ['active' => 0], 15);

        $response = $this->getJson(route('users.nonactive',
            ['length' => 5, 'start' => 0, 'draw' => 0]));

        $this->assertCount(5, $response->json()['data']);

    }

    /** @test */

    public function a_user_can_see_nonactive_users_in_nonactive_route()
    {
        $this->signIn();

        fCreate(Role::class, ['name' => 'admin']);

        $user_active = fCreate(User::class, ['active' => 1]);
        $user_not_active = fCreate(User::class, ['active' => 0]);

        $response = $this->getJson(route('users.nonactive', ['length' => 10, 'start' => 0, 'draw' => 0]));

        $this->assertNotEquals($user_active->name, array_pop($response->json()['data'])['name']);
        $this->assertEquals($user_not_active->name, array_pop($response->json()['data'])['name']);

    }

    /** @test */

    public function a_user_cannot_see_not_active_users_in_nonactive_route()
    {
        $this->signIn();

        fCreate(Role::class, ['name' => 'admin']);

        $user_not_active = fCreate(User::class, ['active' => 1]);

        $response = $this->getJson(route('users.nonactive', ['length' => 10, 'start' => 0, 'draw' => 0]));

        $this->assertNotEquals($user_not_active->name, array_pop($response->json()['data'])['name']);

    }

    /** @test */

    public function a_user_can_activate_an_user()
    {
        $this->signIn();

        fCreate(Role::class, ['name' => 'admin']);

        $user = fCreate(User::class);

        $response = $this->get(route('users.activate', $user->id));

        $response->assertSessionHas('successMessage', trans('helpers::actions.activate_successfully'));

        $this->assertDatabaseHas('users', [
            'name' => $user->name,
            'active' => 1,
            'created_by' => $user->created_by,
            'updated_by' => Auth::id()
        ]);
    }

    /** @test */

    public function a_user_can_deactivate_an_user()
    {
        $this->signIn();

        fCreate(Role::class, ['name' => 'admin']);

        $user = fCreate(User::class);

        $response = $this->get(route('users.deactivate', $user->id));

        $response->assertSessionHas('successMessage', trans('helpers::actions.deactivate_successfully'));

        $this->assertDatabaseHas('users', [
            'name' => $user->name,
            'active' => 0,
            'created_by' => $user->created_by,
            'updated_by' => Auth::id()
        ]);
    }
}
