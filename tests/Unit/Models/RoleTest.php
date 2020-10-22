<?php

namespace Izt\Basics\Tests\Unit\Models;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Izt\Basics\Storage\Eloquent\Models\Application;
use Izt\Basics\Storage\Eloquent\Models\Role;
use Izt\Basics\Storage\Eloquent\Models\User;
use Izt\Basics\Storage\Eloquent\Models\Variable;
use Izt\Basics\Storage\Eloquent\Traits\AbstractTrait;
use Izt\Basics\Tests\TestCase;

class RoleTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */

    public function a_role_belong_to_an_application()
    {
        $app = fCreate(Application::class);
        $role = fCreate(Role::class, ['application_id' => $app->id]);

        $this->assertEquals($app->id, $role->application->id);
    }

    /** @test */

    public function a_role_has_many_user()
    {
        $user = fCreate(User::class);

        $role = fCreate(Role::class);
        $user1 = fCreate(User::class, ['role_name' => $role->name]);
        $user2 = fCreate(User::class, ['role_name' => $role->name]);

        $this->assertEquals(2, $role->users->count());

        $this->assertTrue($role->users->contains($user1));
        $this->assertTrue($role->users->contains($user2));

        $this->assertFalse($role->users->contains($user));
    }

    /** @test */

    public function a_role_is_admin_or_not()
    {
        $role = Role::where('name', 'admin')->first();

        $this->assertTrue($role->isAdmin());

        $role = fCreate(Role::class, ['name' => 'other']);

        $this->assertFalse($role->isAdmin());
    }

    /** @test */

    public function a_role_is_web_or_not()
    {
        $role = Role::where('name', 'web')->first();

        $this->assertTrue($role->isWebUser());

        $role = fCreate(Role::class, ['name' => 'other']);

        $this->assertFalse($role->isWebUser());
    }

    /** @test */

    public function a_role_model_must_use_the_abstract_trait()
    {
        $this->assertClassUsesTrait(AbstractTrait::class, Role::class);
    }

    /** @test */

    public function a_variable_scope_by_show()
    {
        $variable1 = fCreate(Variable::class, ['show' => 1]);
        $variable2 = fCreate(Variable::class, ['show' => 0]);

        $variables = Variable::show(1)->get();

        $this->assertTrue($variables->contains($variable1));
        $this->assertFalse($variables->contains($variable2));
    }

    /** @test */

    public function a_role_with_users_cannot_be_deleted()
    {
        $role = fCreate(Role::class);
        $user = fCreate(User::class, ['role_name' => $role->name]);

        $this->assertFalse($role->canDelete());
    }

    /** @test */

    public function a_role_withouth_users_can_be_deleted()
    {
        $role = fCreate(Role::class);

        $this->assertTrue($role->canDelete());
    }

    /** @test */

    public function a_admin_role_cannot_be_edited()
    {
        $role = Role::where('name', 'admin')->first();

        $this->assertFalse($role->canEdit());
    }

    /** @test */

    public function a_not_admin_role_can_be_edited()
    {
        $role = fCreate(Role::class);

        $this->assertTrue($role->canEdit());
    }
}
