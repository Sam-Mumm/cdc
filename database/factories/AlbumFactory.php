<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Album;
use Faker\Generator as Faker;

$factory->define(Album::class, function (Faker $faker) {
    return [
        'title' => $faker->word,
        'year' => $faker->numberBetween($min = 1970, $max = 2020),
        'genre_id' => $faker->randomNumber(),
        'category_id' => $faker->randomElement($category_list),
        'medium_id' => $faker->randomElement($medium)
    ];
});
