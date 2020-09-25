<?php

namespace Izt\Users\Tests\Feature\Users;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Izt\Users\Storage\Eloquent\Models\Role;
use Izt\Users\Storage\Eloquent\Models\User;
use Izt\Users\Tests\TestCase;

class CreateUsersTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */

    public function user_create_load_ok()
    {
        $this->signIn();

        $this->get(route('users.create'))
            ->assertStatus(200);
    }

    public function a_non_admin_user_cannot_create()
    {
        $this->signIn(null, "other");

        $this->get(route('users.create'))
            ->assertStatus(302)
            ->assertRedirect(route('front.home'));
    }

    /** @test */

    public function a_user_can_create_an_user()
    {
        $this->signIn();

        $role = fCreate(Role::class);
        $user = fMake(User::class, ['role_name' => $role->name]);

        $response = $this->post(route('users.store'), $user->toArray());

        $user = User::latest('id')->first();

        $response->assertSessionHas('successMessage', trans('users::users.store_successfully'));
        $response->assertRedirect(route('users.edit', ['id' => $user->id]));

        $this->assertDatabaseHas('users', [
            'name' => $user->name,
            'email' => $user->email
        ]);
    }

    /** @test */

    public function a_new_user_required_an_unique_email()
    {
        $this->signIn();

        $user1 = fCreate(User::class);
        $user2 = fMake(User::class, ['email' => $user1->email]);

        $response = $this->post(route('users.store'), $user2->toArray());
        $response->assertSessionHasErrors('email');

        $this->assertDatabaseMissing('users', [
            'name' => $user2->name,
            'email' => $user2->email
        ]);
    }

    /** @test */

    public function a_new_user_required_a_name()
    {
        $this->signIn();

        $user = fMake(User::class, ['name' => null]);

        $response = $this->post(route('users.store'), $user->toArray());
        $response->assertSessionHasErrors('name');

        $this->assertDatabaseMissing('users', [
            'name' => $user->name,
            'email' => $user->email
        ]);
    }

    /** @test */

    public function a_new_user_required_a_valid_role_name()
    {
        $this->signIn();

        $user = fMake(User::class, ['role_name' => null]);

        $response = $this->post(route('users.store'), $user->toArray());

        $response->assertSessionHasErrors('role_name');

        $this->assertDatabaseMissing('users', [
            'name' => $user->name,
            'email' => $user->email
        ]);

        $user1 = fMake(User::class, ['role_name' => 'role name']);

        $response = $this->post(route('users.store'), $user1->toArray());

        $response->assertSessionHasErrors('role_name');

        $this->assertDatabaseMissing('users', [
            'name' => $user1->name,
            'email' => $user1->email
        ]);
    }

    /** @test */

    public function a_new_user_required_a_valid_lang()
    {
        $this->signIn();

        $user = fMake(User::class, ['lang' => null]);

        $response = $this->post(route('users.store'), $user->toArray());

        $response->assertSessionHasErrors('lang');

        $this->assertDatabaseMissing('users', [
            'name' => $user->name,
            'email' => $user->email
        ]);

        $user1 = fMake(User::class, ['lang' => 'lang name']);

        $response = $this->post(route('users.store'), $user1->toArray());

        $response->assertSessionHasErrors('lang');

        $this->assertDatabaseMissing('users', [
            'name' => $user1->name,
            'email' => $user1->email
        ]);
    }
}
