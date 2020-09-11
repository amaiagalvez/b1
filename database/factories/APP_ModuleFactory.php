<?php

/** @var Factory $factory */

use Izt\Users\Storage\Eloquent\Models\Module;
use Izt\Users\Storage\Eloquent\Models\User;
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

$factory->define(Module::class, function (Faker $faker) {
    return [
        'name' => $faker->unique()->name,
        'title_eu' => $faker->name . 'EU',
        'title_es' => $faker->name . 'ES',
        'title_fr' => $faker->name . 'FR',
        'title_en' => $faker->name . 'EN',
        'active' => $faker->boolean,
        'created_by' => Auth::id() ?? User::all()->random()->id,
        'updated_by' => Auth::id() ?? User::all()->random()->id
    ];
});
