<?php

namespace Izt\Basics\Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Auth;
use Izt\Basics\Storage\Eloquent\Models\User;
use Izt\Basics\Tests\TestCase;

class HomeTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */

    public function front_home_load_ok()
    {
        $this->get(route('front.home'))
            ->assertStatus(200);
    }

    /** @test */

    public function home_load_ok()
    {
        $this->signIn();

        $this->get(route('home'))
            ->assertStatus(200);
    }
}
