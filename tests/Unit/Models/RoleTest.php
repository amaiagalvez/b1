<?php

namespace Izt\Basics\Tests\Unit;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Izt\Basics\Storage\Eloquent\Models\Role;
use Izt\Basics\Storage\Eloquent\Models\User;
use Izt\Basics\Tests\TestCase;
use Izt\Basics\Storage\Eloquent\Traits\AbstractTrait;

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

    public function a_role_model_must_user_the_base_trait()
    {

        $this->assertClassUsesTrait(AbstractTrait::class, Role::class);
    }
}
