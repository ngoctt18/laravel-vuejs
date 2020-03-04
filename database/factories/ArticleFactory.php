<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Article;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Article::class, function (Faker $faker) {
    $title = $faker->realText($maxNbChars = 60, $indexSize = 2);
    return [
        'title' => $title,
        'slug' => Str::slug($title),
        'body' => $faker->realText($maxNbChars = 200, $indexSize = 2),
        'cat_id' => App\Category::all()->random()->id,
    ];
});
