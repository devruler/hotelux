<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Review;
use App\Room;
use App\User;
use Faker\Generator as Faker;

$factory->define(Review::class, function (Faker $faker) {
    return [
        'comment' => $faker->paragraph(),
        'rating' => $faker->numberBetween(1, 6),
        'is_approved' => $faker->randomElement([0, 1]),
        'room_id' => $faker->randomElement(Room::pluck('id')),
        'user_id' => $faker->randomElement(User::whereRole('customer')->pluck('id')),
    ];
});
