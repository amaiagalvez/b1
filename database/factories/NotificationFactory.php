<?php

/** @var Factory $factory */

use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Support\Str;
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

$factory->define(DatabaseNotification::class, function (Faker $faker) {
    return [
        'id' => Str::uuid()->toString(),
        'type' => 'App\\Notifications\\Example',
        'notifiable_type' => User::class,
        'notifiable_id' => User::take(5)->get()
            ->random()->id,
        'data' => [
            'link' => url('/'),
            'message' => $faker->paragraph
        ],
        'read_at' => null
    ];
});
