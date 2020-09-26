<?php

namespace Izt\Users\Tests\Feature\Users;

use Auth;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Izt\Users\Storage\Eloquent\Models\Role;
use Izt\Users\Storage\Eloquent\Models\User;
use Izt\Users\Tests\TestCase;


class UpdateUsersTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */

    public function user_edit_load_ok()
    {
        $this->signIn();

        $user = fCreate(User::class);

        $this->get(route('users.edit', $user->id))
            ->assertStatus(200);
    }

    public function a_non_admin_user_cannot_edit()
    {
        $this->signIn();

        $user = fCreate(User::class, ['active' => 1, 'role_name' => 'web']);
        $this->actingAs($user);

        $this->get(route('users.edit'))
            ->assertStatus(302)
            ->assertRedirect(route('front.home'));
    }

    /** @test */

    public function a_user_can_edit_her_profile()
    {
        $this->signIn();

        $user = User::findOrFail(Auth::id());

        $this->get(route('users.profile'))
            ->assertStatus(200)
            ->assertSeeText($user->name);
    }

    /** @test */

    public function a_user_can_update_her_profile_but_not_her_role()
    {
        $this->signIn();

        $user = User::findOrFail(Auth::id());
        $role = fCreate(Role::class);

        $response = $this->from(route('users.profile'))
            ->post(route('users.update', $user->id),
                [
                    'name' => 'name updated',
                    'role_name' => $role->name,
                    'notes' => 'notes updated'
                ] + $user->toArray());

        $response->assertSessionHas('successMessage', trans('helpers::actions.update_successfully'));
        $response->assertRedirect(route('home'));

        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'name' => 'name updated',
            'role_name' => $user->role_name,
            'notes' => $user->notes
        ]);

        $this->assertDatabaseMissing('users', [
            'id' => $user->id,
            'name' => 'name updated',
            'role_name' => $role->name,
            'notes' => 'notes updated'
        ]);
    }

    /** @test */

    public function a_user_can_edit_a_user()
    {
        $this->signIn();

        fCreate(Role::class, ['name' => 'admin']);

        $user = fCreate(User::class, ['active' => 1]);

        $response = $this->post(route('users.update', $user->id),
            ['name' => 'name updated'] + $user->toArray());

        $response->assertSessionHas('successMessage', trans('helpers::actions.update_successfully'));

        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'name' => 'name updated'
        ]);

        $response->assertRedirect(route('users.edit', ['id' => $user->id]));
    }

    /** @test */

    public function a_user_is_updated_by_the_logged_user()
    {
        $this->signIn();

        fCreate(Role::class, ['name' => 'admin']);

        $user = fCreate(User::class, ['active' => 1]);

        $response = $this->post(route('users.update', $user->id),
            ['name' => 'name updated'] + $user->toArray());

        $response->assertSessionHas('successMessage', trans('helpers::actions.update_successfully'));

        $this->assertDatabaseHas('users', [
            'name' => 'name updated',
            'created_by' => $user->created_by,
            'updated_by' => Auth::id()
        ]);
    }

    /** @test */

    public function a_user_required_an_unique_email()
    {
        $this->signIn();

        $user1 = fCreate(User::class);
        $user2 = fCreate(User::class);

        $response = $this->post(route('users.update', $user2->id),
            ['email' => $user1->email] + $user2->toArray());

        $response->assertSessionHasErrors('email');

        $this->assertDatabaseHas('users', [
            'name' => $user2->name,
            'email' => $user2->email
        ]);

        $this->assertDatabaseMissing('users', [
            'name' => $user2->name,
            'email' => $user1->email
        ]);
    }

    /** @test */

    public function a_user_required_a_name()
    {
        $this->signIn();

        $user = fCreate(User::class);

        $response = $this->post(route('users.update', $user->id),
            ['name' => null] + $user->toArray());
        $response->assertSessionHasErrors('name');

        $this->assertDatabaseHas('users', [
            'name' => $user->name,
            'email' => $user->email
        ]);

        $this->assertDatabaseMissing('users', [
            'name' => null,
            'email' => $user->email
        ]);
    }

    /** @test */

    public function a_user_required_a_valid_role_name()
    {
        $this->signIn();

        $user = fCreate(User::class);

        $response = $this->post(route('users.update', $user->id),
            ['role_name' => null] + $user->toArray());
        $response->assertSessionHasErrors('role_name');

        $response = $this->post(route('users.update', $user->id),
            ['role_name' => 'role name'] + $user->toArray());
        $response->assertSessionHasErrors('role_name');

        $this->assertDatabaseHas('users', [
            'name' => $user->name,
            'email' => $user->email,
            'role_name' => $user->role_name,
        ]);

        $this->assertDatabaseMissing('users', [
            'name' => $user->name,
            'email' => $user->email,
            'role_name' => 'role name',
        ]);
    }

    /** @test */

    public function a_user_required_a_valid_lang()
    {
        $this->signIn();

        $user = fCreate(User::class);

        $response = $this->post(route('users.update', $user->id),
            ['lang' => null] + $user->toArray());
        $response->assertSessionHasErrors('lang');

        $response = $this->post(route('users.update', $user->id),
            ['lang' => 'lang name'] + $user->toArray());
        $response->assertSessionHasErrors('lang');

        $this->assertDatabaseHas('users', [
            'name' => $user->name,
            'email' => $user->email,
            'lang' => $user->lang,
        ]);

        $this->assertDatabaseMissing('users', [
            'name' => $user->name,
            'email' => $user->email,
            'lang' => 'lang name',
        ]);
    }
}
