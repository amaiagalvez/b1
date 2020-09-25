<?php

namespace Izt\Users\Tests\Feature\Variables;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Izt\Users\Storage\Eloquent\Models\Variable;
use Izt\Users\Tests\TestCase;

class CreateVariablesTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */

    public function a_user_cannot_create_a_variable()
    {
        $this->signIn();

        $variable = fMake(Variable::class);

        $response = $this->call('/admin/erabiltzaileak/sortu', $variable);
        $response->assertStatus(404);

    }
}
