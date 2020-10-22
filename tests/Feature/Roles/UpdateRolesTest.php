<?php

namespace Izt\Basics\Tests\Feature\Roles;

use Auth;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Izt\Basics\Storage\Eloquent\Models\Role;
use Izt\Basics\Storage\Eloquent\Models\User;
use Izt\Basics\Tests\TestCase;


class UpdateRolesTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */

    public function role_edit_load_ok()
    {
        $this->signIn();

        $role = fCreate(Role::class);

        $this->get(route('roles.edit', $role->id))
            ->assertStatus(200);
    }

    public function a_non_admin_user_cannot_edit()
    {
        $this->signIn(null, "other");

        $this->get(route('roles.edit'))
            ->assertStatus(302)
            ->assertRedirect(route('front.home'));
    }

    /** @test */

    public function a_user_can_edit_a_role()
    {
        $this->signIn();

        $role = fCreate(Role::class);

        $response = $this->post(route('roles.update', $role->id),
            ['name' => 'role name updated'] + $role->toArray());

        $this->assertDatabaseHas('APP_roles', [
            'name' => 'role name updated'
        ]);

        $response->assertRedirect(route('roles.edit', ['id' => $role->id]));
    }

    /** @test */

    public function a_user_is_updated_by_the_logged_user()
    {
        $this->signIn();

        $role = fCreate(Role::class);

        $response = $this->post(route('roles.update', $role->id),
            ['name' => 'role name updated'] + $role->toArray());

        $response->assertSessionHas('successMessage', trans('basics::action.update_successfully'));

        $this->assertDatabaseHas('APP_roles', [
            'name' => 'role name updated',
            'created_by' => $role->created_by,
            'updated_by' => Auth::id()
        ]);
    }

    /** @test */

    public function a_role_required_a_name()
    {
        $this->signIn();

        $role = fCreate(Role::class);

        $response = $this->post(route('roles.update', $role->id),
            ['name' => null] + $role->toArray());
        $response->assertSessionHasErrors('name');

        $this->assertDatabaseHas('APP_roles', [
            'name' => $role->name
        ]);

        $this->assertDatabaseMissing('APP_roles', [
            'name' => null
        ]);
    }

    /** @test */

    public function a_role_required_an_unique_name()
    {
        $this->signIn();

        $role1 = fCreate(Role::class);
        $role2 = fCreate(Role::class);

        $response = $this->post(route('roles.update', $role1->id),
            ['name' => $role2->name] + $role1->toArray());
        $response->assertSessionHasErrors('name');
    }

    /** @test */

    public function when_a_role_name_is_updated_all_users_role_will_be_updated()
    {
        $this->signIn();

        $role = fCreate(Role::class);

        $user1 = fCreate(User::class, ['role_name' => 'admin']);
        $user2 = fCreate(User::class, ['role_name' => $role->name]);

        $this->post(route('roles.update', $role->id),
            ['name' => 'name updated'] + $role->toArray());

        $this->assertDatabaseHas('users', [
            'id' => $user1->id,
            'name' => $user1->name,
            'role_name' => $user1->role_name
        ]);

        $this->assertDatabaseMissing('users', [
            'id' => $user2->id,
            'name' => $user2->name,
            'role_name' => $user2->role_name
        ]);

        $this->assertDatabaseHas('users', [
            'id' => $user2->id,
            'name' => $user2->name,
            'role_name' => 'name updated'
        ]);

    }

    /** @test */

    public function a_user_cannot_edit_admin_role()
    {
        $this->signIn();

        $role = Role::where('name', 'admin')->first();

        $response = $this->get(route('roles.edit', $role->id));

        $response->assertStatus(403);
    }

    /** @test */

    public function a_user_cannot_update_admin_role()
    {
        $this->signIn();

        $role = Role::where('name', 'admin')->first();

        $response = $this->post(route('roles.update', $role->id),
            ['name' => 'role name updated'] + $role->toArray());

        $response->assertStatus(403);
    }
}
