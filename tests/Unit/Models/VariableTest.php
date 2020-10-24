<?php

namespace Izt\Basics\Tests\Unit\Models;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Izt\Basics\Storage\Eloquent\Models\Application;
use Izt\Basics\Storage\Eloquent\Models\Role;
use Izt\Basics\Storage\Eloquent\Models\Variable;
use Izt\Basics\Storage\Eloquent\Traits\AbstractTrait;
use Izt\Basics\Tests\TestCase;

class VariableTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */

    public function a_variable_belong_to_an_application()
    {
        $app = fCreate(Application::class);
        $variable = fCreate(Variable::class, ['application_id' => $app->id]);

        $this->assertEquals($app->id, $variable->application->id);
    }

    /** @test */

    public function a_variable_has_a_value()
    {
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

    /** @test */

    public function a_role_scope_by_active()
    {
        $role1 = fCreate(Role::class, ['active' => 1]);
        $role2 = fCreate(Role::class, ['active' => 0]);

        $roles = Role::active(1)->get();

        $this->assertTrue($roles->contains($role1));
        $this->assertFalse($roles->contains($role2));
    }

    /** @test */

    public function a_editable_variable()
    {
        $variable = fCreate(Variable::class, ['editable' => 1]);

        $this->assertTrue($variable->canEdit());
    }

    /** @test */

    public function a_not_editable_variable()
    {
        $variable = fCreate(Variable::class, ['editable' => 0]);

        $this->assertFalse($variable->canEdit());
    }
}
