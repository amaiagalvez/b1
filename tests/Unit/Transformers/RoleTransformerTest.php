<?php

namespace Izt\Basics\Tests\Unit\Transformers\Admin;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Izt\Basics\Http\Transformers\RoleTransformer;
use Izt\Basics\Storage\Eloquent\Models\Role;
use Izt\Basics\Storage\Eloquent\Models\User;
use Izt\Basics\Tests\TestCase;

class RoleTransformerTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp(): void
    {
        parent::setUp();

        $this->seed('BasicsDatabaseSeeder');
    }

    /** @test */

    public function a_role_must_have_the_necessary_fileds()
    {
        $user = fCreate(User::class);

        $role = fCreate(Role::class);

        $rt = new RoleTransformer();
        $roleTransformer = $rt->transform($role);

        $this->assertEquals($role->id, $roleTransformer['id']);
        $this->assertEquals($role->title_en, $roleTransformer['title_en']);
        $this->assertEquals($role->name, $roleTransformer['name']);

    }
}
