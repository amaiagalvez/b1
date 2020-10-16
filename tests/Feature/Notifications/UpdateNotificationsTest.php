<?php

namespace Izt\Basics\Tests\Feature\Notifications;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Support\Facades\Auth;
use Izt\Basics\Tests\TestCase;

class UpdateNotificationsTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp(): void
    {
        parent::setUp();

        $this->seed('BasicsDatabaseSeeder');
    }

    /** @test */

    public function a_guest_cannot_mark_notifications_as_read()
    {
        $this->signIn();

        $notification = fCreate(DatabaseNotification::class, [
            'notifiable_id' => Auth::id(),
            'read_at' => null
        ]);

        Auth::logout();

        $this->post(route('notifications.update', $notification))
            ->assertStatus(302)
            ->assertRedirect(route('login'));

        $this->postJson(route('notifications.update', $notification))
            ->assertStatus(401);
    }

    /** @test */

    public function a_user_can_mark_notifications_as_read()
    {
        $this->signIn();

        $notification = fCreate(DatabaseNotification::class, [
            'notifiable_id' => Auth::id(),
            'read_at' => null
        ]);

        $response = $this->postJson(route('notifications.update', $notification));

        $response->assertJson($notification->fresh()->toArray());

        $this->assertNotNull($notification->fresh()->read_at);
    }

    /** @test */

    public function a_guest_cannot_mark_notifications_as_not_read()
    {
        $this->signIn();

        $notification = fCreate(DatabaseNotification::class, [
            'notifiable_id' => Auth::id(),
            'read_at' => now()
        ]);

        Auth::logout();

        $this->post(route('notifications.update', $notification))
            ->assertStatus(302)
            ->assertRedirect(route('login'));

        $this->postJson(route('notifications.update', $notification))
            ->assertStatus(401);
    }

    /** @test */

    public function a_user_can_mark_notifications_as_not_read()
    {
        $this->signIn();

        $notification = fCreate(DatabaseNotification::class, [
            'notifiable_id' => Auth::id(),
            'read_at' => now()
        ]);

        $response = $this->postJson(route('notifications.update', $notification));

        $response->assertJson($notification->fresh()->toArray());

        $this->assertNull($notification->fresh()->read_at);
    }
}
