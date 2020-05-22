<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Bio;
use App\Models\Info;
use Faker\Generator as Faker;

$factory->define(Info::class, function (Faker $faker) {
    return [
        'weight'      => random_int(50, 150),
        'height'      => random_int(120, 220),
        'blood_type'  => Info::$blood_type[rand(0, 7)],
        'birthday_at' => $faker->dateTime,
        'address'     => "address",
        'created_at'  => \Carbon\Carbon::now()->toDateTimeString(),
        'updated_at'  => \Carbon\Carbon::now()->toDateTimeString()
    ];
});
