<?php

/** @var Factory $factory */

use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;
use Illuminate\Support\Facades\Auth;
use Izt\Users\Storage\Eloquent\Models\Module;
use Izt\Users\Storage\Eloquent\Models\User;
use Izt\Users\Storage\Eloquent\Models\Version;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(Version::class, function (Faker $faker) {
    $users = User::get();
    $by = 0;
    if (count($users) > 0) {
        $by = $users->random()->id;
    }

    $modules = Module::get();
    $module_id = 0;
    if (count($modules) > 0) {
        $module_id = $modules->random()->id;
    }

    $versions = Version::whereNull('parent_id')->get();
    $version_id = 0;
    if (count($versions) > 0) {
        $version_id = $versions->random()->id;
    }

    return [
        'module_id' => $faker->randomElement([null, $module_id]),
        'name' => $faker->unique()->randomFloat(2, 0, 10),
        'parent_id' => $faker->randomElement([null, $version_id]),
        'notes_eu' => $faker->paragraph(3),
        'notes_es' => $faker->paragraph(3),
        'notes_fr' => $faker->paragraph(3),
        'notes_en' => $faker->paragraph(3),
        'active' => $faker->boolean,
        'order' => $faker->numberBetween(0, 25),
        'created_by' => Auth::id() ?? $by,
        'updated_by' => Auth::id() ?? $by
    ];
});
