<?php

namespace Izt\Users\Tests\Unit;

use Izt\Helpers\Storage\Eloquent\Traits\AbstractTrait;
use Izt\Users\Tests\TestCase;
use Izt\Users\Storage\Eloquent\Models\Variable;

class APPVariableTest extends TestCase
{
    /** @test */

    public function a_variable_has_a_value()
    {
        $variable = create(Variable::class, ['value' => 'variable value']);

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
