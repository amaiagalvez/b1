<?php

namespace Izt\Basics\Tests\Feature\Versions;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Izt\Basics\Storage\Eloquent\Models\User;
use Izt\Basics\Storage\Eloquent\Models\Version;
use Izt\Basics\Tests\TestCase;

class ReadVersionsTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */

    public function version_index_load_ok()
    {
        $this->signIn();

        $this->get(route('versions.index'))
            ->assertStatus(200);
    }

    /** @test */

    public function a_non_admin_user_cannot_load_version_index()
    {
        $this->signIn(null, "other");

        $this->get(route('versions.index'))
            ->assertStatus(302)
            ->assertRedirect(route('front.home'));
    }

    /** @test */

    public function a_guest_user_cannot_load_version_index()
    {
        $this->get(route('versions.index'))
            ->assertStatus(302)
            ->assertRedirect(route('login'));
    }

    /** @test */

    public function a_user_can_get_versions()
    {
        $this->signIn();

        fCreate(Version::class, [], 15);

        $version = Version::first();

        $this->get(route('versions.index'))
            ->assertSee($version->name)
            ->assertSee($version->present()->notes);
    }

    /** @test */

    public function a_user_lang_show_table_lang()
    {
        $this->signIn();

        $user = fCreate(User::class, ['lang' => 'es', 'role_name' => 'admin']);
        $this->actingAs($user);

        $variable = fCreate(Version::class,
            ['notes_en' => 'notes1 eu', 'notes_es' => 'notes1 es']);

        $response = $this->get(route('versions.index'));
        $response->assertSee($variable->notes_es);
        $response->assertDontSee($variable->notes_en);
    }
}
