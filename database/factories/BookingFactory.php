<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Booking;
use App\User;
use App\Room;
use Faker\Generator as Faker;

$factory->define(Booking::class, function (Faker $faker) {
    $usersId = collect(User::all()->pluck('id'));
    $roomsId = collect(Room::all()->pluck('id'));
    return [
        'user_id' => $usersId->random(),
        'room_id' => $roomsId->random(),
        'check_in' => $faker->dateTimeBetween($startDate = 'now', $endDate = '60 days', $timezone = null),
        'check_out' => $faker->dateTimeBetween($startDate = '60 days', $endDate = '60 days', $timezone = null),
        'guests' => $faker->randomDigitNot(0),
        'created_at' => $faker->dateTimeBetween($startDate = '-2 days',$endDate = '90 days', $timezone = null),
        'updated_at' => $faker->dateTimeBetween($startDate = '-2 days',$endDate = '90 days', $timezone = null),
    ];
});
