<?php

namespace Izt\Users\Tests\Unit;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Izt\Helpers\Storage\Eloquent\Traits\AbstractTrait;
use Izt\Users\Storage\Eloquent\Models\User;
use Izt\Users\Storage\Eloquent\Models\Variable;
use Izt\Users\Tests\TestCase;

class VariableTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */

    public function a_variable_has_a_value()
    {
        $user = fCreate(User::class);

        $variable = fCreate(Variable::class, ['value' => 'variable value']);

        $this->assertTrue($variable->value === 'variable value');

        $variable = Variable::latest('id')->first();
        $this->assertTrue($variable->value === 'variable value');
    }

    /** @test */

    public function a_variable_model_must_user_the_base_trait()
    {

        $this->assertClassUsesTrait(AbstractTrait::class, Variable::class);

    }
}
