<?php

/** @var Factory $factory */

use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;
use Illuminate\Support\Facades\Auth;
use Izt\Users\Storage\Eloquent\Models\Session;
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

$factory->define(Session::class, function (Faker $faker) {
    $users = User::get();
    $by = 0;
    if (count($users) > 0) {
        $by = $users->random()->id;
    }

    $startingDate = $faker->dateTimeBetween('this week', '+1 days');
    $endingDate = $faker->dateTimeBetween($startingDate, strtotime('+1 days'));

    return [
        'user_id' => $by,
        'login_at' => $startingDate,
        'logout_at' => $endingDate,
        'created_by' => Auth::id() ?? $by,
        'updated_by' => Auth::id() ?? $by
    ];
});
