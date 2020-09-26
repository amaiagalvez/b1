<?php

/** @var Factory $factory */

use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Izt\Helpers\Classes\Languages;
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
    $roles = Role::get();
    $role_name = 'admin';
    if (count($roles) > 0) {
        $role_name = $roles->random()->name;
    }

    $users = User::get();
    $by = 0;
    if (count($users) > 0) {
        $by = $users->random()->id;
    }

    return [
        'name' => str_replace("'", "", $faker->name),
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => Hash::make('123456'),
        'remember_token' => Str::random(10),
        'role_name' => $role_name,
        'lang' => $faker->randomElement(Languages::getSimpleArray()),
        'show_profile' => $faker->boolean,
        'active' => $faker->boolean,
        'created_by' => Auth::id() ?? $by,
        'updated_by' => Auth::id() ?? $by
    ];
});
