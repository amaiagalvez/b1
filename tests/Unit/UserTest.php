<?php

namespace Izt\Basics\Tests\Unit;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Izt\Helpers\Storage\Eloquent\Traits\AbstractTrait;
use Izt\Basics\Storage\Eloquent\Models\Role;
use Izt\Basics\Storage\Eloquent\Models\Session;
use Izt\Basics\Storage\Eloquent\Models\User;
use Izt\Basics\Tests\TestCase;

class UserTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */

    public function a_user_is_admin_or_not()
    {
        $user = fCreate(User::class);

        $this->assertTrue($user->isAdmin());

        $user = fCreate(User::class, ['role_name' => 'other']);

        $this->assertFalse($user->isAdmin());
    }

    /** @test */

    public function only_id_one_is_developer()
    {
        $user1 = fCreate(User::class);
        $user2 = fCreate(User::class);

        $this->assertFalse($user2->isDeveloper());

        $user = User::findOrFail(1);
        $this->assertTrue($user->isDeveloper());
    }

    /** @test */

    public function a_user_has_many_sessions()
    {
        $user = fCreate(User::class);

        $sessions = fCreate(Session::class, ['user_id' => $user->id], 2);

        $this->assertEquals(2, $user->sessions->count());

        $this->assertTrue($user->sessions->contains($sessions->first()));
    }

    /** @test */

    public function a_user_has_one_role()
    {
        $user = fCreate(User::class);

        $role = fCreate(Role::class);
        $user = fCreate(User::class, ['role_name' => $role->name]);

        $this->assertEquals($role->name, $user->role->name);
    }

    /** @test */

    public function a_user_model_must_user_the_base_trait()
    {

        $this->assertClassUsesTrait(AbstractTrait::class, User::class);

    }

    /** @test */

    public function a_user_has_an_avatar()
    {
        $user = fMake(User::class);

        $this->assertEquals('/images/user.png', $user->getAvatar());
    }
}
