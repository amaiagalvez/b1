<?php

namespace Izt\Basics\Tests\Unit\Transformers;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Izt\Basics\Http\Transformers\MenuTransformer;
use Izt\Basics\Storage\Eloquent\Models\Menu;
use Izt\Basics\Tests\TestCase;

class MenuTransformerTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */

    public function a_menu_must_have_the_necessary_fileds()
    {
        $menu = fCreate(Menu::class);

        $mt = new MenuTransformer();
        $menuTransformer = $mt->transform($menu);

        $this->assertEquals($menu->id, $menuTransformer['id']);
        $this->assertEquals(trans('basics::basics.' . $menu->name), $menuTransformer['name']);
        $this->assertEquals($menu->route, $menuTransformer['route']);

    }
}
