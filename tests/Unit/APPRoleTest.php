<?php

namespace Izt\Users\Tests\Unit;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Izt\Helpers\Storage\Eloquent\Traits\AbstractTrait;
use Izt\Users\Storage\Eloquent\Models\Module;
use Izt\Users\Storage\Eloquent\Models\ModuleRole;
use Izt\Users\Storage\Eloquent\Models\Role;
use Izt\Users\Storage\Eloquent\Models\User;
use Izt\Users\Tests\TestCase;

class APPRoleTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */

    public function a_role_has_many_user()
    {
        $role = factory(Role::class)->create();

        $users = factory(User::class, 2)->create(
            ['role_name' => $role->name]
        );

        $this->assertEquals(2, $role->users->count());

        $this->assertTrue($role->users->contains($users->first()));
    }

    /** @test */

    public function a_role_has_many_modules()
    {
        $module1 = factory(Module::class)->create();
        $module2 = factory(Module::class)->create();

        $role = factory(Role::class)->create();

        $this->assertEquals(0, $role->modules->count());

        $role_module1 = factory(ModuleRole::class)->create(
            ['role_id' => $role->id, 'module_id' => $module1->id]
        );

        $role_module2 = factory(ModuleRole::class)->create(
            ['role_id' => $role->id, 'module_id' => $module2->id]
        );

        $this->assertEquals(2, $role->modules()
            ->count());
    }

    /** @test */

    public function a_role_model_must_user_the_base_trait()
    {

        $this->assertClassUsesTrait(AbstractTrait::class, Role::class);
    }
}
