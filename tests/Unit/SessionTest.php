<?php

namespace Izt\Users\Tests\Unit;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Izt\Users\Storage\Eloquent\Models\Session;
use Izt\Users\Storage\Eloquent\Models\User;
use Izt\Users\Tests\TestCase;

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
