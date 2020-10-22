<?php

namespace Izt\Basics\Tests\Unit\Transformers;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Izt\Basics\Http\Transformers\RoleTransformer;
use Izt\Basics\Http\Transformers\SessionTransformer;
use Izt\Basics\Storage\Eloquent\Models\Role;
use Izt\Basics\Storage\Eloquent\Models\Session;
use Izt\Basics\Storage\Eloquent\Models\User;
use Izt\Basics\Tests\TestCase;

class SessionTransformerTest extends TestCase
{
    use DatabaseMigrations;

/** @test */

    public function a_session_must_have_the_necessary_fileds()
    {
        $session = fCreate(Session::class);

        $st = new SessionTransformer();
        $sessionTransformer = $st->transform($session);

        $this->assertEquals($session->id, $sessionTransformer['id']);
        $this->assertEquals($session->login_at, $sessionTransformer['login_at']);
        $this->assertEquals($session->logout_at, $sessionTransformer['logout_at']);
        $this->assertEquals($session->total, $sessionTransformer['total']);
    }
}
