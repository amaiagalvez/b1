<?php

namespace Izt\Basics\Tests\Unit;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Izt\Helpers\Storage\Eloquent\Traits\AbstractTrait;
use Izt\Basics\Storage\Eloquent\Models\Module;
use Izt\Basics\Storage\Eloquent\Models\ModuleRole;
use Izt\Basics\Storage\Eloquent\Models\Role;
use Izt\Basics\Storage\Eloquent\Models\User;
use Izt\Basics\Tests\TestCase;

class RoleTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */

    public function a_role_has_many_user()
    {
        $user = fCreate(User::class);

        $role = fCreate(Role::class);
        $users = fCreate(User::class, ['role_name' => $role->name], 2);

        $this->assertEquals(2, $role->users->count());

        $this->assertTrue($role->users->contains($users->first()));
    }

    /** @test */

    public function a_role_has_many_modules()
    {
        $user = fCreate(User::class);

        $module1 = fCreate(Module::class);
        $module2 = fCreate(Module::class);

        $role = fCreate(Role::class);

        $this->assertEquals(0, $role->modules->count());

        $role_module1 = fCreate(ModuleRole::class, [
            'role_id' => $role->id,
            'module_id' => $module1->id
        ]);

        $role_module2 = fCreate(ModuleRole::class, [
            'role_id' => $role->id,
            'module_id' => $module2->id
        ]);

        $this->assertEquals(2, $role->modules()
            ->count());
    }

    /** @test */

    public function a_role_model_must_user_the_base_trait()
    {

        $this->assertClassUsesTrait(AbstractTrait::class, Role::class);
    }
}
