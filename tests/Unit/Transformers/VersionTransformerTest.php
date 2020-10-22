<?php

namespace Izt\Basics\Tests\Unit\Transformers;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Izt\Basics\Http\Transformers\RoleTransformer;
use Izt\Basics\Http\Transformers\VariableTransformer;
use Izt\Basics\Http\Transformers\VersionTransformer;
use Izt\Basics\Storage\Eloquent\Models\Role;
use Izt\Basics\Storage\Eloquent\Models\User;
use Izt\Basics\Storage\Eloquent\Models\Variable;
use Izt\Basics\Storage\Eloquent\Models\Version;
use Izt\Basics\Tests\TestCase;

class VersionTransformerTest extends TestCase
{
    use DatabaseMigrations;

/** @test */

    public function a_version_must_have_the_necessary_fileds()
    {
        $version = fCreate(Version::class);

        $vt = new VersionTransformer();
        $versionTransformer = $vt->transform($version);

        $this->assertEquals($version->id, $versionTransformer['id']);
        $this->assertEquals($version->notes_en, $versionTransformer['notes_en']);

        $this->assertEquals(null, $versionTransformer['notes_eu'] ?? null);

    }
}
