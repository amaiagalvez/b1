<?php

namespace Izt\Basics\Tests\Unit\Transformers;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Izt\Basics\Http\Transformers\RoleTransformer;
use Izt\Basics\Http\Transformers\VariableTransformer;
use Izt\Basics\Storage\Eloquent\Models\Role;
use Izt\Basics\Storage\Eloquent\Models\User;
use Izt\Basics\Storage\Eloquent\Models\Variable;
use Izt\Basics\Tests\TestCase;

class VariableTransformerTest extends TestCase
{
    use DatabaseMigrations;

/** @test */

    public function a_variable_must_have_the_necessary_fileds()
    {
        $variable = fCreate(Variable::class);

        $vt = new VariableTransformer();
        $variableTransformer = $vt->transform($variable);

        $this->assertEquals($variable->id, $variableTransformer['id']);
        $this->assertEquals($variable->title_en, $variableTransformer['title_en']);
        $this->assertEquals($variable->notes_en, $variableTransformer['notes_en']);

        $this->assertEquals(null, $variableTransformer['title_eu'] ?? null);
        $this->assertEquals(null, $variableTransformer['notes_eu'] ?? null);
    }
}
