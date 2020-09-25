<?php

namespace Izt\Users\Tests\Feature\Variables;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Izt\Users\Storage\Eloquent\Models\Variable;
use Izt\Users\Tests\TestCase;

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
