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

    $startDate = $faker->dateTimeBetween('this week', '+1 days')->format('Y-m-d H:i:s');
    $endDate = $faker->dateTimeBetween($startDate, strtotime('+1 days'))->format('Y-m-d H:i:s');

    return [
        'user_id' => User::take(5)->get()
            ->random()->id,
        'login_at' => $startDate,
        'logout_at' => $endDate,
        'created_by' => Auth::id() ?? User::take(5)->get()
                ->random()->id,
        'updated_by' => Auth::id() ?? User::take(5)->get()
                ->random()->id
    ];
});
