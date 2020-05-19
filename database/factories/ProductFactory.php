<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Models\Product;

use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'description' => $faker->text,
        //'price' =>  12.34,
        'slug' => $faker->slug,
        'image' => $faker->imageUrl(100, 200)
    ];
});
