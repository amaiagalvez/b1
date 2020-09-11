<?php

/** @var Factory $factory */

use Izt\Users\Storage\Eloquent\Models\Module;
use Izt\Users\Storage\Eloquent\Models\ModuleRole;
use Izt\Users\Storage\Eloquent\Models\Role;
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

$factory->define(ModuleRole::class, function (Faker $faker) {
    return [
        'role_id' => Role::where('name', '<>', 'admin')->get()->random()->id,
        'module_id' => Module::all()->random()->id,
        'created_by' => Auth::id() ?? User::all()->random()->id,
        'updated_by' => Auth::id() ?? User::all()->random()->id
    ];
});
