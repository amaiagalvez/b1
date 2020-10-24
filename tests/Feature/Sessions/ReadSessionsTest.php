<?php

namespace Izt\Basics\Tests\Feature\Sessions;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Izt\Basics\Storage\Eloquent\Models\Session;
use Izt\Basics\Storage\Eloquent\Models\User;
use Izt\Basics\Tests\TestCase;

class ReadSessionsTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */

    public function session_index_load_ok()
    {
        $this->signIn();

        $this->get(route('sessions.index'))
            ->assertStatus(200);
    }

    /** @test */

    public function a_non_admin_user_cannot_load_session_index()
    {
        $this->signIn(null, "other");

        $this->get(route('sessions.index'))
            ->assertStatus(302)
            ->assertRedirect(route('front.home'));
    }

    /** @test */

    public function a_guest_user_cannot_load_session_index()
    {
        $this->get(route('sessions.index'))
            ->assertStatus(302)
            ->assertRedirect(route('login'));
    }

    /** @test */

    public function a_user_can_get_sessions_paginated()
    {
        $this->signIn();

        fCreate(Session::class, [], 15);

        $response = $this->getJson(route('sessions.index',
            ['length' => 5, 'start' => 0, 'draw' => 0]));

        $this->assertCount(5, $response->json()['data']);

    }

    /** @test */

    public function a_user_can_see_sessions_in_index_route()
    {
        $this->signIn();

        $session = fCreate(Session::class, ['login_at' => '3000-01-01 10:33:01']);

        $response = $this->getJson(route('sessions.index', ['length' => 10, 'start' => 0, 'draw' => 0]));

        $this->assertEquals($session->login_at, array_pop($response->json()['data'])['login_at']);

    }

    /** @test */

    public function a_user_can_search_sessions_by_user()
    {
        $this->signIn();

        $user = fCreate(User::class);
        $session = fCreate(Session::class, ['login_at' => '3000-01-01 10:01:01', 'user_id' => $user->id]);

        $response = $this->getJson(route('sessions.index',
            ['search_user' => $user->id]));

        $this->assertEquals($session->login_at, array_pop($response->json()['data'])['login_at']);

        $user2 = fCreate(User::class);
        $session2 = fCreate(Session::class, ['login_at' => '3001-01-01 10:01:01', 'user_id' => $user2->id]);

        $response = $this->getJson(route('sessions.index',
            ['search_user' => $user->id]));

        $this->assertNotEquals($session2->login_at, array_pop($response->json()['data'])['login_at']);
    }

    /** @test */

    public function a_user_can_search_by_year()
    {
        $this->signIn();

        $session2 = fCreate(Session::class, ['login_at' => '3000-01-01 10:01:01']);

        $response = $this->getJson(route('sessions.index',
            ['search_year' => 3000]));

        $this->assertEquals($session2->login_at, array_pop($response->json()['data'])['login_at']);

        $session = fCreate(Session::class, ['login_at' => '3001-01-01 10:01:01']);

        $response = $this->getJson(route('sessions.index',
            ['search_year' => 3000]));

        $this->assertNotEquals($session->login_at, array_pop($response->json()['data'])['login_at']);
    }
}
