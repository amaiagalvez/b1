<?php

namespace Izt\Basics\Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Auth;
use Izt\Basics\Storage\Eloquent\Models\User;
use Izt\Basics\Tests\TestCase;

class LoginTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */

    public function login_load_ok()
    {
        $this->withoutExceptionHandling();

        $this->app->make('Illuminate\Contracts\Http\Kernel')->pushMiddleware('Illuminate\Session\Middleware\StartSession');
        $this->app->make('Illuminate\Contracts\Http\Kernel')->pushMiddleware('Illuminate\View\Middleware\ShareErrorsFromSession');

        $this->get(route('login'))
            ->assertStatus(200);
    }

    /** @test */

    public function not_logged_user_is_redirected_to_login_form()
    {
        $response = $this->get(route('home'));

        $response->assertStatus(302);
        $response->assertRedirect(route('login'));
    }

    /** @test */

    public function logged_user_go_to_home()
    {
        $this->signIn();
        $response = $this->get(route('home'));

        $response->assertStatus(200)
            ->assertSee(Auth::user()->name);
    }

    /** @test */

    public function an_active_user_can_log_in()
    {
        $user = fCreate(User::class, ['active' => 1]);

        $response = $this->from(route('home'))
            ->post(route('login', [
                'email' => $user->email,
                'password' => $user->password
            ]));

        $response->assertStatus(302)
            ->assertRedirect(route('home'));
    }

    /** @test */

    public function a_non_active_user_cannot_log_in()
    {
        $user = fCreate(User::class, ['active' => 0]);

        $response = $this->from('login')->post(route('login', [
            'email' => $user->email,
            'password' => $user->password
        ]));

        $response->assertStatus(302)
            ->assertRedirect(route('login'));
    }
}
