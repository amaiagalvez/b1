<?php

/** @var Factory $factory */

use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;
use Illuminate\Support\Facades\Auth;
use Izt\Users\Storage\Eloquent\Models\Module;
use Izt\Users\Storage\Eloquent\Models\User;

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
    $users = User::get();
    $by = 0;
    if (count($users) > 0) {
        $by = $users->random()->id;
    }

    return [
        'name' => $faker->unique()->name,
        'title_eu' => $faker->name . 'EU',
        'title_es' => $faker->name . 'ES',
        'title_fr' => $faker->name . 'FR',
        'title_en' => $faker->name . 'EN',
        'active' => $faker->boolean,
        'created_by' => Auth::id() ?? $by,
        'updated_by' => Auth::id() ?? $by
    ];
});