<?php

namespace Izt\Users\Tests\Unit\Transformers\Admin;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Izt\Users\Http\Transformers\RoleTransformer;
use Izt\Users\Storage\Eloquent\Models\Role;
use Izt\Users\Tests\TestCase;

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
        $this->assertEquals($role->title_en, $roleTransformer['title_en']);
        $this->assertEquals($role->name, $roleTransformer['name']);

    }
}
