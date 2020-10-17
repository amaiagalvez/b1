<?php

namespace Izt\Basics\Tests\Feature\Variables;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Izt\Basics\Storage\Eloquent\Models\Variable;
use Izt\Basics\Tests\TestCase;

class DeleteVariablesTest extends TestCase
{
    use DatabaseMigrations;

/** @test */

    public function a_user_cannot_delete_a_variable()
    {
        $this->signIn();

        $variable = fCreate(Variable::class);

        $response = $this->call('/admin/erabiltzaileak/delete', $variable->id);
        $response->assertStatus(404);

    }
}
