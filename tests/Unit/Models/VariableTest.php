<?php

namespace Izt\Basics\Tests\Unit\Models;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Izt\Basics\Storage\Eloquent\Models\User;
use Izt\Basics\Storage\Eloquent\Models\Variable;
use Izt\Basics\Tests\TestCase;
use Izt\Basics\Storage\Eloquent\Traits\AbstractTrait;

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

    public function a_variable_model_must_use_the_abstract_trait()
    {

        $this->assertClassUsesTrait(AbstractTrait::class, Variable::class);

    }
}
