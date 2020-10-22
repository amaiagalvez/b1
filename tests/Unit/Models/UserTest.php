<?php

namespace Izt\Basics\Tests\Unit\Models;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Notifications\DatabaseNotification;
use Izt\Basics\Storage\Eloquent\Models\Role;
use Izt\Basics\Storage\Eloquent\Models\Session;
use Izt\Basics\Storage\Eloquent\Models\User;
use Izt\Basics\Storage\Eloquent\Traits\AbstractTrait;
use Izt\Basics\Tests\TestCase;

class UserTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */

    public function a_user_is_admin_or_not()
    {
        $user = fCreate(User::class, ['role_name' => 'admin']);

        $this->assertTrue($user->isAdmin());

        $user = fCreate(User::class, ['role_name' => 'other']);

        $this->assertFalse($user->isAdmin());
    }

    /** @test */

    public function only_id_one_is_developer()
    {
        $user = User::findOrFail(1);
        $this->assertTrue($user->isDeveloper());

        $user1 = fCreate(User::class);
        $this->assertFalse($user1->isDeveloper());

    }

    /** @test */

    public function a_user_has_many_sessions()
    {
        $user = fCreate(User::class);

        $sessions = fCreate(Session::class, ['user_id' => $user->id], 2);

        $this->assertEquals(2, $user->sessions->count());

        $this->assertTrue($user->sessions->contains($sessions->first()));
        $this->assertTrue($user->sessions->contains($sessions->last()));
    }

    /** @test */

    public function a_user_has_many_notifications()
    {
        $user = fCreate(User::class);
        $notification = fCreate(DatabaseNotification::class, [
            'notifiable_id' => $user->id
        ]);

        $this->assertEquals(1, $user->notifications->count());
        $this->assertTrue($user->notifications->contains($notification));
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

    public function a_user_model_must_use_the_abstract_trait()
    {

        $this->assertClassUsesTrait(AbstractTrait::class, User::class);

    }

    /** @test */

    public function a_user_has_an_avatar()
    {
        $user = fMake(User::class);

        $this->assertEquals('/images/user.png', $user->getAvatar());
    }

    /** @test */

    public function a_user_scope_by_active()
    {
        $user1 = fCreate(User::class, ['active' => 1]);
        $user2 = fCreate(User::class, ['active' => 0]);

        $users = User::active(1)->get();

        $this->assertTrue($users->contains($user1));
        $this->assertFalse($users->contains($user2));
    }

    /** @test */

    public function a_user_scope_by_lang()
    {
        $user1 = fCreate(User::class, ['lang' => 'eu']);
        $user2 = fCreate(User::class, ['lang' => 'es']);

        $users = User::lang('eu')->get();

        $this->assertTrue($users->contains($user1));
        $this->assertFalse($users->contains($user2));
    }

    /** @test */

    public function a_user_scope_by_roleName()
    {
        $user1 = fCreate(User::class, ['role_name' => 'admin']);
        $user2 = fCreate(User::class, ['role_name' => 'web']);

        $users = User::roleName('admin')->get();

        $this->assertTrue($users->contains($user1));
        $this->assertFalse($users->contains($user2));
    }

    /** @test */

    public function a_user_scope_by_onlyUsers()
    {
        $user1 = User::where('id', 1)->first();
        $user2 = fCreate(User::class);

        $users = User::onlyUsers()->get();

        $this->assertTrue($users->contains($user2));
        $this->assertFalse($users->contains($user1));
    }

    /** @test */

    public function a_user_with_sessions_cannot_be_deleted()
    {
        $user = fCreate(User::class);
        $session = fCreate(Session::class, ['user_id' => $user->id]);

        $this->assertFalse($user->canDelete());
    }

    /** @test */

    public function a_user_withouth_sessions_can_be_deleted()
    {
        $user = fCreate(User::class);

        $this->assertTrue($user->canDelete());
    }
}
