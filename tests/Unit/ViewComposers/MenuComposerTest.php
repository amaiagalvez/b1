<?php

namespace Izt\Basics\Tests\Unit\ViewComposers;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Izt\Basics\Tests\TestCase;

class MenuComposerTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */

    public function a_view_recives_menus()
    {
        $this->signIn();

        //TODO: nola orkortu bista??

        $this->get(route('home'))->assertViewHas('menus');
        $this->get(route('roles.index'))->assertViewHas('menus');
    }

}
