<?php

namespace Izt\Basics\Tests\Unit\Models;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Izt\Basics\Storage\Eloquent\Models\Application;
use Izt\Basics\Storage\Eloquent\Models\Menu;
use Izt\Basics\Storage\Eloquent\Models\Role;
use Izt\Basics\Storage\Eloquent\Models\User;
use Izt\Basics\Storage\Eloquent\Models\Variable;
use Izt\Basics\Storage\Eloquent\Models\Version;
use Izt\Basics\Tests\TestCase;
use Izt\Basics\Storage\Eloquent\Traits\AbstractTrait;

class VersionTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */

    public function a_version_belong_to_an_application()
    {
        $app = fCreate(Application::class);
        $version = fCreate(Version::class, ['application_id' => $app->id]);

        $this->assertEquals($app->id, $version->application->id);
    }
}
