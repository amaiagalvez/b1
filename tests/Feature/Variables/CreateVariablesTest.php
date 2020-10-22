<?php

namespace Izt\Basics\Tests\Feature\Variables;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Izt\Basics\Storage\Eloquent\Models\Variable;
use Izt\Basics\Tests\TestCase;

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
