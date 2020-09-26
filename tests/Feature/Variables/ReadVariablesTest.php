<?php

namespace Izt\Users\Tests\Feature\Variables;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Izt\Users\Storage\Eloquent\Models\User;
use Izt\Users\Storage\Eloquent\Models\Variable;
use Izt\Users\Tests\TestCase;

class ReadVariablesTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp(): void
    {
        parent::setUp();

        $this->seed('VariablesTableSeeder');
    }

    /** @test */

    public function variable_index_load_ok()
    {
        $this->signIn();

        $this->get(route('variables.index'))
            ->assertStatus(200);
    }

    /** @test */

    public function a_non_admin_user_cannot_load_variable_index()
    {
        $this->signIn(null, "other");

        $this->get(route('variables.index'))
            ->assertStatus(302)
            ->assertRedirect(route('front.home'));
    }

    /** @test */

    public function a_user_can_get_variables_paginated()
    {
        $this->signIn();

        $response = $this->getJson(route('variables.index',
            ['length' => 5, 'start' => 0, 'draw' => 0]));
        $this->assertCount(5, $response->json()['data']);

    }

    /** @test */

    public function a_user_can_see_only_active_and_show_variables()
    {
        $this->signIn();

        $variable_active = fCreate(Variable::class, ['active' => 1, 'show' => 1, 'order' => 0]);
        $variable_not_show = fCreate(Variable::class, ['active' => 1, 'show' => 0, 'order' => 0]);

        $response = $this->getJson(route('variables.index', ['length' => 10, 'start' => 0, 'draw' => 0]));

        $this->assertEquals($variable_active->title_en, array_pop($response->json()['data'])['title_en']);
        $this->assertNotEquals($variable_not_show->title_en, array_pop($response->json()['data'])['title_en']);

    }

    /** @test */

    public function a_user_cannot_see_not_active_variables()
    {
        $this->signIn();

        $variable_not_active = fCreate(Variable::class, ['active' => 0, 'show' => 1, 'order' => 0]);

        $response = $this->getJson(route('variables.index', ['length' => 10, 'start' => 0, 'draw' => 0]));

        $this->assertNotEquals($variable_not_active->title_en, array_pop($response->json()['data'])['title_en']);

    }

    /** @test */

    public function a_user_lang_show_table_lang()
    {
        $this->signIn();

        $user = fCreate(User::class, ['lang' => 'es', 'role_name' => 'admin']);
        $this->actingAs($user);

        $variable = fCreate(Variable::class,
            ['title_en' => 'izena1 eu', 'title_es' => 'nombre1 es', 'active' => 1, 'show' => 1, 'order' => 0]);

        $response = $this->getJson(route('variables.index', ['length' => 10, 'start' => 0, 'draw' => 0]));
        $this->assertEquals($variable->title_es, array_pop($response->json()['data'])['title_es']);
        $this->assertNotEquals($variable->title_en, array_pop($response->json()['data'])['title_en'] ?? '');

    }
}
