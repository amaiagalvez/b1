<?php

namespace Izt\Users\Tests\Unit;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Izt\Users\Storage\Eloquent\Models\User;
use Izt\Helpers\Storage\Eloquent\Traits\AbstractTrait;
use Izt\Users\Storage\Eloquent\Models\Module;
use Izt\Users\Storage\Eloquent\Models\ModuleRole;
use Izt\Users\Storage\Eloquent\Models\Role;
use Izt\Users\Tests\TestCase;

class APPRoleTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */

    public function a_role_has_many_user()
    {
        $role = create(Role::class);

        $users = create(User::class, ['role_name' => $role->name], 2);

        $this->assertEquals(2, $role->users->count());

        $this->assertTrue($role->users->contains($users->first()));
    }

    /** @test */

    public function a_role_has_many_modules()
    {
        $module1 = create(Module::class);
        $module2 = create(Module::class);

        $role = create(Role::class);
        $this->assertEquals(0, $role->modules->count());

        $role_module1 = create(ModuleRole::class, ['role_id' => $role->id, 'module_id' => $module1->id]);
        $role_module2 = create(ModuleRole::class, ['role_id' => $role->id, 'module_id' => $module2->id]);

        $this->assertEquals(2, $role->modules()
            ->count());
    }

    /** @test */

    public function a_role_model_must_user_the_base_trait()
    {

        $this->assertClassUsesTrait(AbstractTrait::class, Role::class);
    }
}
