<?php

namespace Izt\Basics\Tests\Unit\Models;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Izt\Basics\Storage\Eloquent\Models\Role;
use Izt\Basics\Storage\Eloquent\Models\User;
use Izt\Basics\Storage\Eloquent\Traits\AbstractTrait;
use Izt\Basics\Tests\TestCase;

class RoleTest extends TestCase
{
    use DatabaseMigrations;

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
    }

    /** @test */

    public function a_role_model_must_use_the_abstract_trait()
    {
        $this->assertClassUsesTrait(AbstractTrait::class, Role::class);
    }
}
