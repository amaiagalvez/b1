<?php

namespace Izt\Basics\Tests\Unit\Transformers;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Izt\Basics\Http\Transformers\RoleTransformer;
use Izt\Basics\Storage\Eloquent\Models\Role;
use Izt\Basics\Tests\TestCase;

class RoleTransformerTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */

    public function a_role_must_have_the_necessary_fileds()
    {
        $role = fCreate(Role::class);

        $rt = new RoleTransformer();
        $roleTransformer = $rt->transform($role);

        $this->assertEquals($role->id, $roleTransformer['id']);
        $this->assertEquals($role->name, $roleTransformer['name']);
        $this->assertEquals($role->title_en, $roleTransformer['title_en']);
        $this->assertEquals($role->notes_en, $roleTransformer['notes_en']);

        $this->assertEquals(null, $roleTransformer['title_eu'] ?? null);
        $this->assertEquals(null, $roleTransformer['notes_eu'] ?? null);
    }
}
