<?php

namespace Izt\Basics\Tests\Unit\Transformers;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Izt\Basics\Http\Transformers\ApplicationTransformer;
use Izt\Basics\Storage\Eloquent\Models\Application;
use Izt\Basics\Storage\Eloquent\Models\Role;
use Izt\Basics\Storage\Eloquent\Models\User;
use Izt\Basics\Tests\TestCase;

class ApplicationTransformerTest extends TestCase
{
    use DatabaseMigrations;

/** @test */

    public function a_application_must_have_the_necessary_fileds()
    {
        $application = fCreate(Application::class);

        $at = new ApplicationTransformer();
        $applicationTransformer = $at->transform($application);

        $this->assertEquals($application->id, $applicationTransformer['id']);
        $this->assertEquals($application->title_en, $applicationTransformer['title_en']);
        $this->assertEquals($application->notes_en, $applicationTransformer['notes_en']);
        $this->assertEquals($application->icon, $applicationTransformer['icon']);
        $this->assertEquals($application->order, $applicationTransformer['order']);

        $this->assertEquals(null, $applicationTransformer['title_eu'] ?? null);
        $this->assertEquals(null, $applicationTransformer['notes_eu'] ?? null);
    }
}
