<?php

/** @var Factory $factory */

use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Izt\Basics\Classes\Languages;
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

$factory->define(User::class, function (Faker $faker) {

    return [
        'name' => str_replace("'", "", $faker->name),
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => Hash::make('123456'),
        'remember_token' => Str::random(10),
        'role_name' => Role::take(5)->get()
            ->random()->name,
        'lang' => $faker->randomElement(Languages::getSimpleArray()),
        'show_profile' => $faker->boolean,
        'active' => $faker->boolean,
        'created_by' => Auth::id() ?? User::take(5)->get()
                ->random()->id,
        'updated_by' => Auth::id() ?? User::take(5)->get()
                ->random()->id
    ];
});
