<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use Illuminate\Support\Str;

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

$factory->define(\App\Models\Admin::class, function (Faker $faker) {
    return [
        'name'              => $faker->firstName,
        'family'            => $faker->lastName,
        'email'             => $faker->unique()->safeEmail,
        'mobile'            => '09'.rand(111111111,999999999),
        'email_verified_at' => now(),
        'password'          => \Illuminate\Support\Facades\Hash::make('123456789'),
        'remember_token'    => Str::random(10),
        'active'            => rand(0, 1)
    ];
});
