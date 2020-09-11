<?php

namespace Izt\Users\Tests\Unit;

use Izt\Users\Storage\Eloquent\Models\User;
use Izt\Users\Storage\Eloquent\Models\Session;
use Izt\Users\Tests\TestCase;

class APPSessionTest extends TestCase
{
    /** @test */

    public function a_session_belong_to_a_user()
    {
        $user1 = create(User::class);
        $session = create(Session::class, ['user_id' => $user1->id]);

        $this->assertEquals($user1->id, $session->user->id);
    }
}
