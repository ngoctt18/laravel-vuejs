<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Category;
use Faker\Generator as Faker;

$factory->define(Category::class, function (Faker $faker) {
    $title = $faker->realText($maxNbChars = 20, $indexSize = 2);
    return [
        'title' => $title,
        'slug' => Str::slug($title),
    ];
});
