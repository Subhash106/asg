<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Product::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'category_id' => function () {
            return factory(App\Models\Category::class)->create()->id;
        },
        'price' => $faker->biasedNumberBetween($min = 99, $max = 999, $function = 'sqrt')
    ];
});
