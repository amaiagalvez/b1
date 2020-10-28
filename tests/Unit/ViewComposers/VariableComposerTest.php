<?php

namespace Izt\Basics\Tests\Unit\ViewComposers;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Izt\Basics\Tests\TestCase;

class VariableComposerTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */

    public function a_view_recives_variables()
    {

        $this->signIn();

        $this->markTestIncomplete('Nola frogatu hau??');

        $this->get(route('home'))->assertViewHas('app_name');
        $this->get(route('roles.index'))->assertViewHas('app_name');
    }

}
