<?php

namespace Izt\Users\Tests\Feature;

use GuzzleHttp\Middleware;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Support\Facades\Session;
use Izt\Users\Listeners\LogSuccessfulLogin;
use Izt\Users\Listeners\LogSuccessfulLogout;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Logout;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;
use Izt\Users\Storage\Eloquent\Models\User;
use Izt\Users\Tests\TestCase;
use Mockery;

class SessionTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */

    public function logged_user_has_a_session()
    {
        $user = fCreate(User::class, ['active' => 1, 'role_name'=> 'admin']);

        $this->post(route('login', [
            'email' => $user->email,
            'password' => $user->password
        ]));

        Event::fake();
        $event = Mockery::mock(Login::class);
        $event->user = $user;

        $listener = App::make(LogSuccessfulLogin::class);
        $listener->handle($event);

        $this->assertDatabaseHas('APP_sessions', [
            'user_id' => $user->id,
            'logout_at' => null
        ]);
    }

    /** @test */

    public function logout_user_has_a_session_with_logout_at()
    {
        $user = Auth::user();
        $this->withExceptionHandling();
        Auth::logout();

        Event::fake();
        $event = Mockery::mock(Logout::class);
        $event->user = $user;

        $listener = App::make(LogSuccessfulLogout::class);
        $listener->handle($event);

        $this->assertDatabaseMissing('APP_sessions', [
            'user_id' => $user->id,
            'logout_at' => null
        ]);
    }

}
