<?php

namespace Izt\Users\Tests\Feature\Roles;

use Auth;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Izt\Users\Storage\Eloquent\Models\Module;
use Izt\Users\Storage\Eloquent\Models\Role;
use Izt\Users\Storage\Eloquent\Models\User;
use Izt\Users\Tests\TestCase;


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

        $response->assertSessionHas('successMessage', trans('users::users.update_successfully'));

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

    public function a_role_name_updated_all_users_will_be_updated()
    {
        $this->signIn();

        $role = fCreate(Role::class);

        $user1 = fCreate(User::class, ['role_name' => 'admin']);
        $user2 = fCreate(User::class, ['role_name' => $role->name]);

        $this->post(route('roles.update', $role->id),
            ['name' => 'izena-role name updated'] + $role->toArray());

        $this->assertDatabaseHas('users', [
            'name' => $user1->name,
            'role_name' => $user1->role_name
        ]);

        $this->assertDatabaseMissing('users', [
            'name' => $user2->name,
            'role_name' => $user2->role_name
        ]);

        $this->assertDatabaseHas('users', [
            'name' => $user2->name,
            'role_name' => 'izena-role name updated'
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

    /** @test */

    public function update_role_with_modules()
    {
        $this->signIn();

        $module1 = fCreate(Module::class);
        $module2 = fCreate(Module::class);
        $module3 = fCreate(Module::class);

        $role = fMake(Role::class, ['modules' => [$module1->id, $module2->id]]);

        $response = $this->post(route('roles.store'), $role->toArray());

        $new_role = Role::latest('id')->first();

        $response->assertSessionHas('successMessage', trans('users::users.store_successfully'));

        $this->post(route('roles.update', $new_role->id),
            ['modules' => [$module3->id]] + $new_role->toArray());

        $this->assertDatabaseHas('APP_roles', [
            'name' => $new_role->name
        ]);

        $this->assertDatabaseMissing('APP_modules_roles', [
            'role_id' => $new_role->id,
            'module_id' => $module1->id
        ]);

        $this->assertDatabaseMissing('APP_modules_roles', [
            'role_id' => $new_role->id,
            'module_id' => $module2->id
        ]);

        $this->assertDatabaseHas('APP_modules_roles', [
            'role_id' => $new_role->id,
            'module_id' => $module3->id
        ]);
    }
}
