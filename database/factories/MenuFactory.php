<?php

/** @var Factory $factory */

use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;
use Illuminate\Support\Facades\Auth;
use Izt\Basics\Storage\Eloquent\Models\Menu;
use Izt\Basics\Storage\Eloquent\Models\Module;
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

$factory->define(Menu::class, function (Faker $faker) {
    return [
        'module_id' => $faker->randomElement([
            null,
            Module::all()
                ->random()->id
        ]),
        'name' => $faker->unique()->name,
        'active' => $faker->boolean,
        'created_by' => Auth::id() ?? User::all()
                ->random()->id,
        'updated_by' => Auth::id() ?? User::all()
                ->random()->id
    ];
});
