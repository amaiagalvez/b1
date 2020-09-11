<?php

/** @var Factory $factory */

use Izt\Users\Storage\Eloquent\Models\Module;
use Izt\Users\Storage\Eloquent\Models\User;
use Izt\Users\Storage\Eloquent\Models\Version;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;
use Illuminate\Support\Facades\Auth;

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
    return [
        'module_id' => $faker->randomElement([null, Module::all()->random()->id]),
        'name' => $faker->unique()->randomFloat(2, 0, 10),
        'parent_id' => $faker->randomElement([null, Version::whereNull('parent_id')->get()->random()->id]),
        'notes_eu' => $faker->paragraph(3),
        'notes_es' => $faker->paragraph(3),
        'notes_fr' => $faker->paragraph(3),
        'notes_en' => $faker->paragraph(3),
        'active' => $faker->boolean,
        'order' => $faker->numberBetween(0, 25),
        'created_by' => Auth::id() ?? User::all()->random()->id,
        'updated_by' => Auth::id() ?? User::all()->random()->id
    ];
});
