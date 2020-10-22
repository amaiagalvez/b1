<?php

namespace Izt\Basics\Tests\Unit\Models;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Izt\Basics\Storage\Eloquent\Models\Session;
use Izt\Basics\Storage\Eloquent\Models\User;
use Izt\Basics\Tests\TestCase;

class SessionTest extends TestCase
{
    use DatabaseMigrations;

/** @test */

    public function a_session_belong_to_a_user()
    {
        $user = fCreate(User::class);
        $session = fCreate(Session::class, ['user_id' => $user->id]);

        $this->assertEquals($user->id, $session->user->id);
    }

    /** @test */

    public function a_session_has_total_duration() {
        $session = fCreate(Session::class, [
            'login_at' =>  '2020-01-01 10:00:00',
            'logout_at' => '2020-01-01 10:32:00',
        ]);

        $total = getDataDiff($session->login_at, $session->logout_at);
        $this->assertEquals($session->total, $total);
        $this->assertEquals($session->total, '00:32:00');
    }
}
