<?php

namespace Izt\Basics\Tests\Unit\Models;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Izt\Basics\Storage\Eloquent\Models\Application;
use Izt\Basics\Storage\Eloquent\Models\Menu;
use Izt\Basics\Storage\Eloquent\Traits\AbstractTrait;
use Izt\Basics\Tests\TestCase;

class MenuTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */

    public function a_menu_belong_to_an_application()
    {
        $app = fCreate(Application::class);
        $menu = fCreate(Menu::class, ['application_id' => $app->id]);

        $this->assertEquals($app->id, $menu->application->id);
    }

    /** @test */

    public function a_submenu_belongs_to_a_menu()
    {
        $menu = fCreate(Menu::class);
        $sub_menu = fCreate(Menu::class, ['parent_id' => $menu->id]);

        $this->assertEquals($menu->id, $sub_menu->menu->id);
    }

    /** @test */

    public function a_menu_model_must_use_the_abstract_trait()
    {
        $this->assertClassUsesTrait(AbstractTrait::class, Menu::class);
    }

    /** @test */

    public function a_menu_scope_by_active()
    {
        $menu1 = fCreate(Menu::class, ['active' => 1]);
        $menu2 = fCreate(Menu::class, ['active' => 0]);

        $menus = Menu::active(1)->get();

        $this->assertTrue($menus->contains($menu1));
        $this->assertFalse($menus->contains($menu2));
    }

    /** @test */

    public function a_menu_scope_by_parent_id_null()
    {
        $menu1 = fCreate(Menu::class, ['parent_id' => null]);
        $menu2 = fCreate(Menu::class, ['parent_id' => $menu1]);

        $menus = Menu::main()->get();

        $this->assertTrue($menus->contains($menu1));
        $this->assertFalse($menus->contains($menu2));
    }

}
