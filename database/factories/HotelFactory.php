<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Hotel;
use Faker\Generator as Faker;

$factory->define(Hotel::class, function (Faker $faker) {
    return [
        'name' => $faker->company(),
        'address' => $faker->address() ,
        'city' => $faker->city() ,
        'state' => $faker->state(),
        'postal_code' => $faker->postcode(),
        'description' => $faker->paragraph(),
        'phone' => $faker->phoneNumber(),
        'country' => $faker->country(),
    ];
});
