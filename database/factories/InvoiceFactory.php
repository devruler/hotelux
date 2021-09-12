<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Booking;
use App\Invoice;
use Faker\Generator as Faker;

$factory->define(Invoice::class, function (Faker $faker) {
    // $bookingsId = Booking::whereDoesntHave('invoice')->pluck('id')->toArray();
    return [
        'booking_id' => function() {
            return factory(Booking::class)->create()->id;
        },
        'total' => $faker->randomFloat($nbMaxDecimals = 2, $min = 100, $max = 1000),
        'payment_type' => 'Credit Card',
        'status' => 1,
        'created_at' => $faker->dateTimeBetween($startDate = '-2 days',$endDate = '90 days', $timezone = null),
        'updated_at' => $faker->dateTimeBetween($startDate = '-2 days',$endDate = '90 days', $timezone = null),
    ];
});
