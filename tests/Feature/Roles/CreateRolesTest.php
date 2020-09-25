<?php

namespace Izt\Users\Tests\Feature\Roles;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Lang;
use Izt\Users\Storage\Eloquent\Models\Module;
use Izt\Users\Storage\Eloquent\Models\Role;
use Izt\Users\Tests\TestCase;

class CreateRolesTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp(): void
    {
        parent::setUp();

        $this->seed('VariablesTableSeeder');
    }

    /** @test */

    public function role_create_load_ok()
    {
        $this->signIn();

        $this->get(route('roles.create'))
            ->assertStatus(200);
    }

    /** @test */

    public function a_non_admin_user_cannot_create_a_role()
    {
        $this->signIn(null, 'web');

        $this->withoutExceptionHandling();

        $this->get(route('roles.create'))
            ->assertStatus(302)
            ->assertRedirect(route('front.home'));
    }

    /** @test */

    public function a_user_can_create_a_role()
    {
        $this->signIn();

        $role = fMake(Role::class);

        $response = $this->post(route('roles.store'), $role->toArray());

        $role = Role::latest('id')
            ->first();

        $response->assertSessionHas('successMessage', trans('helpers::actions.store_successfully'));

        $this->assertDatabaseHas('APP_roles', [
            'name' => $role->name
        ]);

        $response->assertRedirect(route('roles.edit', ['id' => $role->id]));
    }

    /** @test */

    public function a_new_role_required_an_unique_name()
    {
        $this->signIn();

        $role1 = fCreate(Role::class);
        $role2 = fMake(Role::class, ['name' => $role1->name]);

        $response = $this->post(route('roles.store'), $role2->toArray());
        $response->assertSessionHasErrors('name');
    }

    /** @test */

    public function a_new_role_with_modules()
    {
        $this->signIn();

        $module1 = fCreate(Module::class);
        $module2 = fCreate(Module::class);

        $role = fMake(Role::class, ['modules' => [$module1->id, $module2->id]]);

        $response = $this->post(route('roles.store'), $role->toArray());

        $new_role = Role::latest('id')
            ->first();

        $response->assertSessionHas('successMessage', Lang::get('helpers::actions.store_successfully'));

        $this->assertDatabaseHas('APP_roles', [
            'name' => $role->name
        ]);

        $this->assertDatabaseHas('APP_modules_roles', [
            'role_id' => $new_role->id,
            'module_id' => $module1->id
        ]);

        $this->assertDatabaseHas('APP_modules_roles', [
            'role_id' => $new_role->id,
            'module_id' => $module2->id
        ]);
    }
}
