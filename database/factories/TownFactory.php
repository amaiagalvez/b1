<?php

/** @var Factory $factory */

use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;
use Illuminate\Support\Facades\Auth;
use Izt\Basics\Storage\Eloquent\Models\Community;
use Izt\Basics\Storage\Eloquent\Models\Country;
use Izt\Basics\Storage\Eloquent\Models\District;
use Izt\Basics\Storage\Eloquent\Models\State;
use Izt\Basics\Storage\Eloquent\Models\Town;
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

$factory->define(Town::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'code' => $faker->unique()->text(5),
        'capital_city' => $faker->boolean,
        'district_id' => District::get()->random()->id,
        'country_id' => Country::get()->random()->id,
        'community_id' => Community::get()->random()->id,
        'state_id' => State::get()->random()->id,
        'active' => $faker->boolean,
        'created_by' => Auth::id() ?? User::take(5)->get()
                ->random()->id,
        'updated_by' => Auth::id() ?? User::take(5)->get()
                ->random()->id
    ];
});
