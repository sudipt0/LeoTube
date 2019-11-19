<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Video;
use Faker\Generator as Faker;

$factory->define(Video::class, function (Faker $faker) {
    return [
        'channel_id' => function () {
            return factory(Channel::class)->create()->id;
        },
        'views' => $faker->numberBetween(10,100000),
        'thumbnail' => $faker->imageUrl(),
        'percentage' => 100,
        'title' => $faker->sentence(4),
        'description' => $faker->sentence(10),
        'path' => $faker->word()  
    ];
});