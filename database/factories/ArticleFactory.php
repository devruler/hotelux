<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Article;
use App\User;
use Faker\Generator as Faker;

$factory->define(Article::class, function (Faker $faker) {
    $users = collect(User::whereRole('admin')->pluck('id'));
    return [
        'title' => $faker->sentence(),
        'content' => $faker->paragraphs(5),
        'image' => $faker->file('C:\Users\hp\Desktop\room_images', public_path('/images/articles'), false),
        'published' => $faker->randomElement([0,1]),
        'user_id' => $faker->randomElement([0,1]),
    ];
});
