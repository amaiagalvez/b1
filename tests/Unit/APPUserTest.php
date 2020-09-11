<?php

namespace Izt\Users\Tests\Unit;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Izt\Helpers\Storage\Eloquent\Traits\AbstractTrait;
use Izt\Users\Storage\Eloquent\Models\Role;
use Izt\Users\Storage\Eloquent\Models\Session;
use Izt\Users\Storage\Eloquent\Models\User;
use Izt\Users\Tests\TestCase;

class APPUserTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */

    public function a_user_is_admin_or_not()
    {
        $user = factory(User::class)->create(['role_name' => 'admin']);

        $this->assertTrue($user->isAdmin());

        $user = factory(User::class)->create(['role_name' => 'user']);

        $this->assertFalse($user->isAdmin());
    }

    /** @test */

    public function only_id_one_is_developer()
    {
        $user1 = factory(User::class)->create();
        $user2 = factory(User::class)->create();

        $this->assertFalse($user2->isDeveloper());

        $user = User::findOrFail(1);
        $this->assertTrue($user->isDeveloper());
    }

    /** @test */

    public function a_user_has_many_sessions()
    {
        $user = factory(User::class)->create();

        $sessions = factory(Session::class, 2)->create(['user_id' => $user->id]);

        $this->assertEquals(2, $user->sessions->count());

        $this->assertTrue($user->sessions->contains($sessions->first()));
    }

    /** @test */

    public function a_user_has_one_role()
    {
        $role = factory(Role::class)->create();
        $user = factory(User::class)->create(['role_name' => $role->name]);

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
        $user = factory(User::class)->make();

        $this->assertEquals('/images/user.png', $user->getAvatar());
    }
}
