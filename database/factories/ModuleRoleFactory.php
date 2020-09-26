<?php

/** @var Factory $factory */

use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;
use Illuminate\Support\Facades\Auth;
use Izt\Basics\Storage\Eloquent\Models\Module;
use Izt\Basics\Storage\Eloquent\Models\ModuleRole;
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

$factory->define(ModuleRole::class, function (Faker $faker) {
    $users = User::get();
    $by = 0;
    if (count($users) > 0) {
        $by = $users->random()->id;
    }

    $roles = Role::where('name', '<>', 'admin')->get();
    $role_id = 0;
    if (count($roles) > 0) {
        $role_id = $roles->random()->id;
    }

    $modules = Module::get();
    $module_id = 0;
    if (count($modules) > 0) {
        $module_id = $modules->random()->id;
    }

    return [
        'role_id' => $role_id,
        'module_id' => $module_id,
        'created_by' => Auth::id() ?? $by,
        'updated_by' => Auth::id() ?? $by
    ];
});
