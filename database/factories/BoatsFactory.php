<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Boat;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Boat::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'short_description' => $faker->text,
        'description' => $faker->text,
        'type' => $faker->numberBetween(1,5),
        'class' => $faker->numberBetween(1,5),
        'price' => $faker->numberBetween(2000,5000),
        'capacity' =>  $faker->numberBetween(20,300),
        'year_built' =>  $faker->numberBetween(1970,2020),
        'length' =>  $faker->numberBetween(50,200),
        'beam' =>   $faker->numberBetween(20,80),
        'speed' =>  $faker->numberBetween(50,150),
        'draft' =>  $faker->numberBetween(20,80),
        'main_engines' => $faker->name,
        'gross_tonnage' =>  $faker->name,
        'electricity' =>  $faker->name,
    ];
});
