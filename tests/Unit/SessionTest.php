<?php

namespace Izt\Basics\Tests\Unit;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Izt\Basics\Storage\Eloquent\Models\Session;
use Izt\Basics\Storage\Eloquent\Models\User;
use Izt\Basics\Tests\TestCase;

class APPSessionTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */

    public function a_session_belong_to_a_user()
    {
        $user = fCreate(User::class);
        $session = fCreate(Session::class, ['user_id' => $user->id]);

        $this->assertEquals($user->id, $session->user->id);
    }
}
