<?php

/** @var Factory $factory */

use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;
use Illuminate\Support\Facades\Auth;
use Izt\Basics\Storage\Eloquent\Models\Session;
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

$factory->define(Session::class, function (Faker $faker) {

    $startingDate = $faker->dateTimeBetween('this week', '+1 days');
    $endingDate = $faker->dateTimeBetween($startingDate, strtotime('+1 days'));

    return [
        'user_id' => User::take(5)->get()
            ->random()->id,
        'login_at' => $startingDate,
        'logout_at' => $endingDate,
        'created_by' => Auth::id() ?? User::take(5)->get()
                ->random()->id,
        'updated_by' => Auth::id() ?? User::take(5)->get()
                ->random()->id
    ];
});
