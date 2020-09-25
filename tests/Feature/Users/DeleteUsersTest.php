<?php

namespace Izt\Users\Tests\Feature\Users;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Izt\Users\Storage\Eloquent\Models\Session;
use Izt\Users\Storage\Eloquent\Models\User;
use Izt\Users\Tests\TestCase;

class DeleteUsersTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */

    public function user_trash_load_ok()
    {
        $this->signIn();

        $this->get(route('users.trash'))
            ->assertStatus(200);
    }

    /** @test */

    public function a_user_can_get_deleted_users_paginated()
    {
        $this->signIn();

        fCreate(User::class, ['deleted_at' => '2020-01-01'], 15);

        $response = $this->getJson(route('users.trash',
            ['length' => 5, 'start' => 0, 'draw' => 0]));

        $this->assertCount(5, $response->json()['data']);

    }

    /** @test */

    public function a_user_can_see_deleted_users_in_trash_route()
    {
        $this->signIn();

        $user_deleted = fCreate(User::class, ['deleted_at' => '2020-01-01']);
        $user_not_deleted = fCreate(User::class);

        $response = $this->getJson(route('users.trash', ['length' => 10, 'start' => 0, 'draw' => 0]));

        $this->assertEquals($user_deleted->name, array_pop($response->json()['data'])['name']);
        $this->assertNotEquals($user_not_deleted->name, array_pop($response->json()['data'])['name']);

    }

    /** @test */

    public function a_user_cannot_see_not_deleted_users_in_trash_route()
    {
        $this->signIn();

        $user_not_deleted = fCreate(User::class);

        $response = $this->getJson(route('users.trash', ['length' => 10, 'start' => 0, 'draw' => 0]));

        $this->assertNotEquals($user_not_deleted->name, array_pop($response->json()['data'])['name']);

    }

    /** @test */

    public function a_user_can_delete_an_user_if_not_used()
    {
        $this->signIn();

        $user = fCreate(User::class);

        $response = $this->from(route('users.index'))
            ->post(route('users.delete', $user->id))
            ->assertStatus(302)
            ->assertRedirect(route('users.index'));

        $response->assertSessionHas('successMessage', trans('users::users.delete_successfully'));

        $this->assertDatabaseMissing('users', [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'deleted_at' => null
        ]);
    }

    /** @test */

    public function a_user_cannot_delete_an_user_if_used()
    {
        $this->signIn();

        $user = fCreate(User::class);
        fCreate(Session::class, ['user_id' => $user->id], 2);

        $response = $this->post(route('users.delete', $user->id));

        $response->assertSessionHas('errorMessage', trans('users::users.cannot_delete'));

        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'deleted_at' => null
        ]);
    }

    /** @test */

    public function a_user_can_restore_a_deleted_user()
    {
        $this->signIn();

        $user = fCreate(User::class, ['deleted_at' => '2020-01-01']);

        $response = $this->get(route('users.restore', $user->id));

        $response->assertSessionHas('successMessage', trans('users::users.restore_successfully'));

        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'deleted_at' => null
        ]);
    }

    /** @test */

    public function a_user_can_force_delete_a_deleted_user()
    {
        $this->signIn();

        $user = fCreate(User::class, ['deleted_at' => '2020-01-01']);

        $response = $this->post(route('users.destroy', $user->id));

        $response->assertSessionHas('successMessage', trans('users::users.delete_successfully'));

        $this->assertDatabaseMissing('users', [
            'id' => $user->id
        ]);
    }
}
