<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Hotel;
use App\Room;
use Faker\Generator as Faker;

$factory->define(Room::class, function (Faker $faker) {
    $title = $faker->sentence();
    $slug = str_replace(' ', '-', $title);

    $images = [];
    $numberOfImages = $faker->randomElement([2, 3]);
    $i = 0;
    for($numberOfImages; $i <= $numberOfImages; $i++){
        $images[] = $faker->file('C:\Users\hp\Desktop\room_images', public_path('/images/rooms'), false);
    }

    return [
        'title' => $title,
        'slug' => $slug,
        'type' => $faker->word(),
        'images' => $images,
        'description' => $faker->paragraph(),
        'price' => $faker->randomFloat(2, 0, 1000),
        'capacity' => $faker->randomDigitNot(0),
        'published' => $faker->randomElement([0,1]),
        'created_at' => $faker->dateTimeBetween($min = '-30 days', $max = 'today'),
        'hotel_id' => $faker->randomElement(Hotel::pluck('id')),
    ];
});
