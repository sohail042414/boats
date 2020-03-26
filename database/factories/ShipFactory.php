<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Ship;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Ship::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'image' => 'default_boat.jpg',
        'ship_link' =>$faker->url,
        'short_description' => $faker->text,
        'title_description_1' => $faker->text,
        'title_description_2' => $faker->text,
        'title_description_3' => $faker->text,
        'price' => $faker->numberBetween(2000,5000),
        'capacity' =>  $faker->numberBetween(20,300),
        'ship_type' => $faker->numberBetween(1,5),
        'cruise_category' => $faker->numberBetween(1,5),
        'capacity_category' => $faker->numberBetween(1,3),
        'year_built' =>  $faker->numberBetween(1970,2020),
        'year_renovated' => $faker->numberBetween(1980,2020),
        'length' =>  $faker->numberBetween(50,200),
        'beam' =>   $faker->numberBetween(20,80),
        'top_speed' =>  $faker->numberBetween(50,150),
        'engines' => $faker->name,
        'cabins' => $faker->numberBetween(2,8),  
        'draft' =>  $faker->numberBetween(20,80),        
        'gross_tonnage' =>  $faker->name,
        'electricity' =>   $faker->numberBetween(100,120),
    ];

});
