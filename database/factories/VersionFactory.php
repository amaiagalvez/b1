<?php

/** @var Factory $factory */

use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;
use Illuminate\Support\Facades\Auth;
use Izt\Basics\Storage\Eloquent\Models\Application;
use Izt\Basics\Storage\Eloquent\Models\User;
use Izt\Basics\Storage\Eloquent\Models\Version;

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

    return [
        'application_id' => Application::all()->random()->id,
        'name' => $faker->unique()->randomFloat(2, 0, 10),
        'notes_eu' => $faker->paragraph(3) . ' EU',
        'notes_es' => $faker->paragraph(3) . ' ES',
        'notes_fr' => $faker->paragraph(3) . ' FR',
        'notes_en' => $faker->paragraph(3) . ' EN',
        'created_by' => Auth::id() ?? User::take(5)->get()
                ->random()->id,
        'updated_by' => Auth::id() ?? User::take(5)->get()
                ->random()->id
    ];
});
