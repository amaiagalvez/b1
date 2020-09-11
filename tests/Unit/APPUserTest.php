<?php

namespace Izt\Users\Tests\Unit;

use Izt\Helpers\Storage\Eloquent\Traits\AbstractTrait;
use Izt\Users\Tests\TestCase;
use Izt\Users\Storage\Eloquent\Models\Role;
use Izt\Users\Storage\Eloquent\Models\Session;
use Izt\Users\Storage\Eloquent\Models\User;

class APPUserTest extends TestCase
{
    /** @test */

    public function a_user_is_admin_or_not()
    {
        $user = create(User::class, ['role_name' => 'admin']);

        $this->assertTrue($user->isAdmin());

        $user = create(User::class, ['role_name' => 'user']);

        $this->assertFalse($user->isAdmin());
    }

    /** @test */

    public function only_id_one_is_developer()
    {
        $user = create(User::class);
        $this->assertFalse($user->isDeveloper());

        $user = User::findOrFail(1);
        $this->assertTrue($user->isDeveloper());
    }

    /** @test */

    public function a_user_has_many_sessions()
    {
        $user = create(User::class);

        $sessions = create(Session::class, ['user_id' => $user->id], 2);

        $this->assertEquals(2, $user->sessions->count());

        $this->assertTrue($user->sessions->contains($sessions->first()));
    }

    /** @test */

    public function a_user_has_one_role()
    {
        $role = create(Role::class);
        $user = create(User::class, ['role_name' => $role->name]);

        $this->assertEquals($role->name, $user->role->name);
    }

    /** @test */

    public function a_user_model_must_user_the_base_trait()
    {

        $this->assertClassUsesTrait(AbstractTrait::class, User::class);

    }

    /** @test */

    public function a_user_has_a_link_to_their_profile()
    {
        $user = factory(User::class)->create();
        $this->assertEquals(route('front.users.show', $user->id), $user->link());
    }

    /** @test */

    public function a_user_has_an_avatar()
    {
        $user = factory(User::class)->make();

        $this->assertEquals('/images/user.png', $user->getAvatar());
    }
}
