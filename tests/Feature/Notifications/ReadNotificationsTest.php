<?php

namespace Izt\Users\Tests\Feature\Notifications;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Support\Facades\Auth;
use Izt\Users\Tests\TestCase;

class ReadNotificationsTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */

    public function a_guest_cannot_get_their_notifications()
    {
        $this->get(route('notifications.index'))
            ->assertStatus(302)
            ->assertRedirect(route('login'));

        $this->getJson(route('notifications.index'))
            ->assertStatus(401);
    }

    /** @test */

    public function a_user_can_get_their_notifications()
    {
        $this->signIn();

        $notification = fCreate(DatabaseNotification::class, [
            'notifiable_id' => Auth::id()
        ]);

        $this->getJson(route('notifications.index'))
            ->assertJson([
                [
                    'data' => [
                        'link' => $notification->data['link'],
                        'message' => $notification->data['message']
                    ]
                ]
            ]);
    }
}
