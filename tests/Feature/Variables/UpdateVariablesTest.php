<?php

namespace Izt\Basics\Tests\Feature\Variables;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Auth;
use Izt\Basics\Storage\Eloquent\Models\Variable;
use Izt\Basics\Tests\TestCase;


class UpdateVariablesTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp(): void
    {
        parent::setUp();

        $this->seed('VariablesTableSeeder');
    }

    /** @test */

    public function variable_edit_load_ok()
    {
        $this->signIn();

        $variable = fCreate(Variable::class, ['editable' => 1]);

        $this->get(route('variables.edit', $variable->id))
            ->assertStatus(200);
    }

    public function a_non_admin_user_cannot_edit()
    {
        $this->signIn(null, "other");

        $this->get(route('users.edit'))
            ->assertStatus(302)
            ->assertRedirect(route('front.home'));
    }

    /** @test */

    public function a_user_can_edit_a_variable_only_if_editable()
    {
        $this->signIn();

        $variable = fCreate(Variable::class, ['active' => 1, 'show' => 1, 'editable' => 1, 'order' => 0]);

        $response = $this->post(route('variables.update', $variable->id),
            ['value' => 'value updated'] + $variable->toArray());

        $this->assertDatabaseHas('APP_variables', [
            'id' => $variable->id,
            'name' => $variable->name,
            'value' => 'value updated'
        ]);

        $response->assertSessionHas('successMessage', trans('helpers::action.update_successfully'));

        $response->assertRedirect(route('variables.edit', ['id' => $variable->id]));
    }

    /** @test */

    public function a_user_cannot_edit_a_variable_if_not_editable()
    {
        $this->signIn();

        $variable = fCreate(Variable::class, ['active' => 1, 'show' => 1, 'editable' => 0, 'order' => 0]);

        $this->get(route('variables.edit', $variable->id))
            ->assertStatus(403);

        $response = $this->post(route('variables.update', $variable->id),
            ['value' => 'value updated'] + $variable->toArray());

        $this->assertDatabaseHas('APP_variables', ['value' => $variable->value]);
        $this->assertDatabaseMissing('APP_variables', ['value' => 'value updated']);

        $response->assertStatus(403);
    }

    /** @test */

    public function a_variable_is_updated_by_the_logged_user()
    {
        $this->signIn();

        $variable = fCreate(Variable::class, ['active' => 1, 'show' => 1, 'editable' => 1, 'order' => 0]);

        $response = $this->post(route('variables.update', $variable->id),
            ['value' => 'value updated'] + $variable->toArray());

        $response->assertSessionHas('successMessage', trans('helpers::action.update_successfully'));

        $this->assertDatabaseHas('APP_variables', [
            'value' => 'value updated',
            'created_by' => $variable->created_by,
            'updated_by' => Auth::id()
        ]);
    }

    /** @test */

    public function a_user_cannot_title_update()
    {
        $this->signIn();

        $variable = fCreate(Variable::class, ['active' => 1, 'show' => 1, 'editable' => 1, 'order' => 0]);

        $response = $this->post(route('variables.update', $variable->id),
            ['title_eu' => 'title updated', 'value' => 'value updated'] + $variable->toArray());

        $response->assertSessionHas('successMessage', trans('helpers::action.update_successfully'));

        $this->assertDatabaseMissing('APP_variables', [
            'title_eu' => 'title updated',
            'value' => 'value updated',
            'created_by' => $variable->created_by,
            'updated_by' => Auth::id()
        ]);

        $this->assertDatabaseHas('APP_variables', [
            'title_eu' => $variable->title_eu,
            'value' => 'value updated',
            'created_by' => $variable->created_by,
            'updated_by' => Auth::id()
        ]);
    }
}
