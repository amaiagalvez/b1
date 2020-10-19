<?php

/** @var Factory $factory */

use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;
use Illuminate\Support\Facades\Auth;
use Izt\Basics\Storage\Eloquent\Models\Application;
use Izt\Basics\Storage\Eloquent\Models\Role;
use Izt\Basics\Storage\Eloquent\Models\User;

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

$factory->define(Role::class, function (Faker $faker) {

    return [
        'application_id' => $faker->randomElement([
            null,
            Application::all()
                ->random()->id
        ]),
        'name' => $faker->unique()->userName,
        'title_eu' => $faker->word,
        'title_es' => $faker->word,
        'title_fr' => $faker->word,
        'title_en' => $faker->word,
        'active' => $faker->boolean,
        'created_by' => Auth::id() ?? User::take(5)->get()
                ->random()->id,
        'updated_by' => Auth::id() ?? User::take(5)->get()
                ->random()->id
    ];
});
