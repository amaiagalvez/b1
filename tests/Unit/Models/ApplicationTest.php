<?php

namespace Izt\Basics\Tests\Unit\Models;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Izt\Basics\Storage\Eloquent\Models\Application;
use Izt\Basics\Storage\Eloquent\Models\Menu;
use Izt\Basics\Storage\Eloquent\Models\Role;
use Izt\Basics\Storage\Eloquent\Models\Variable;
use Izt\Basics\Storage\Eloquent\Models\Version;
use Izt\Basics\Tests\TestCase;

class ApplicationTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */

    public function a_application_has_many_menus()
    {
        $menu = fCreate(Menu::class);

        $application = fCreate(Application::class);
        $menu1 = fCreate(Menu::class, ['application_id' => $application->id]);
        $menu2 = fCreate(Menu::class, ['application_id' => $application->id]);

        $this->assertEquals(2, $application->menus->count());

        $this->assertTrue($application->menus->contains($menu1));
        $this->assertTrue($application->menus->contains($menu2));

        $this->assertFalse($application->menus->contains($menu));
    }

    /** @test */

    public function a_application_has_many_variables()
    {
        $variable = fCreate(Variable::class);

        $application = fCreate(Application::class);
        $variable1 = fCreate(Variable::class, ['application_id' => $application->id]);
        $variable2 = fCreate(Variable::class, ['application_id' => $application->id]);

        $this->assertEquals(2, $application->variables->count());

        $this->assertTrue($application->variables->contains($variable1));
        $this->assertTrue($application->variables->contains($variable2));

        $this->assertFalse($application->variables->contains($variable));
    }

    /** @test */

    public function a_application_has_many_roles()
    {
        $role = fCreate(Role::class);

        $application = fCreate(Application::class);
        $role1 = fCreate(Role::class, ['application_id' => $application->id]);
        $role2 = fCreate(Role::class, ['application_id' => $application->id]);

        $this->assertEquals(2, $application->roles->count());

        $this->assertTrue($application->roles->contains($role1));
        $this->assertTrue($application->roles->contains($role2));

        $this->assertFalse($application->roles->contains($role));
    }

    /** @test */

    public function a_application_has_many_versions()
    {
        $version = fCreate(Version::class);

        $application = fCreate(Application::class);
        $version1 = fCreate(Version::class, ['application_id' => $application->id]);
        $version2 = fCreate(Version::class, ['application_id' => $application->id]);

        $this->assertEquals(2, $application->versions->count());

        $this->assertTrue($application->versions->contains($version1));
        $this->assertTrue($application->versions->contains($version2));

        $this->assertFalse($application->versions->contains($version));
    }
}
