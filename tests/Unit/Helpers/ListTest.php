<?php

namespace Izt\Basics\Tests\Unit\Helpers;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Izt\Basics\Tests\TestCase;

class ListTest extends TestCase
{
    use DatabaseMigrations;

    /** @test * */

    public function it_returns_a_comma_separated_string()
    {
        $this->assertEquals(
            "eu, es",
            getList('["eu", "es"]')
        );
    }
}
