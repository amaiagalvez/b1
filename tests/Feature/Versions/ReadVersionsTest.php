<?php

namespace Izt\Basics\Tests\Feature\Versions;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Izt\Basics\Storage\Eloquent\Models\Version;
use Izt\Basics\Tests\TestCase;

class ReadVersionsTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */

    public function version_index_load_ok()
    {
        $this->signIn();

        $this->get(route('versions.show'))
            ->assertStatus(200);
    }

    /** @test */

    public function a_non_admin_user_cannot_load_version_index()
    {
        $this->signIn(null, "other");

        $this->get(route('versions.show'))
            ->assertStatus(302)
            ->assertRedirect(route('front.home'));
    }

    /** @test */

    public function a_user_can_get_versions()
    {
        $this->signIn();

        fCreate(Version::class, [], 15);

        $version = Version::main()->first();

        $this->get(route('versions.show'))
            ->assertSee($version->present()->name)
            ->assertSee($version->present()->notes);

    }
}
