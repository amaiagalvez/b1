<?php

namespace Izt\Basics\Tests\Feature\Roles;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Izt\Basics\Storage\Eloquent\Models\Role;
use Izt\Basics\Tests\TestCase;

class CreateRolesTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */

    public function role_create_load_ok()
    {

        $this->signIn();

        $this->get(route('roles.create'))
            ->assertStatus(200);
    }

    /** @test */

    public function a_guest_cannot_create_a_role()
    {
        $this->get(route('roles.create'))
            ->assertStatus(302)
            ->assertRedirect(route('login'));
    }

    /** @test */

    public function a_non_admin_user_cannot_create_a_role()
    {
        $this->signIn(null, "other");

        $this->get(route('roles.create'))
            ->assertStatus(302)
            ->assertRedirect(route('front.home'));
    }

    /** @test */

    public function an_admin_user_can_create_a_role()
    {
        $this->signIn();

        $role = fMake(Role::class);

        $response = $this->post(route('roles.store'), $role->toArray());

        $role = Role::latest('id')
            ->first();

        $response->assertSessionHas('successMessage', trans('basics::action.store_successfully'));

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

    public function a_new_role_required_an_application()
    {
        $this->signIn();

        $role = fMake(Role::class, ['application_id' => null]);

        $response = $this->post(route('roles.store'), $role->toArray());
        $response->assertSessionHasErrors('application_id');
    }

    /** @test */

    public function a_new_role_required_a_name()
    {
        $this->signIn();

        $role = fMake(Role::class, ['name' => null]);

        $response = $this->post(route('roles.store'), $role->toArray());
        $response->assertSessionHasErrors('name');
    }
}
