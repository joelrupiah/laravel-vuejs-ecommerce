<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model\Category;
use App\Model\Product;
use App\User;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'category_id' => function(){
            return Category::all()->random();
        },
        'name' => $faker->name,
        'price' => function(){
            return rand(10, 100);
        },
        'discount_price' => function(){
            return rand(10, 100);
        },
        'description' => $faker->text(),
        'image' => $faker->imageUrl($width = 640, $height = 480),
        'flavor' => function(){
            $flavors = ['chocolate', 'vanilla', 'strawberry', 'dry'];
            return $flavors[rand(0,3)];
        },
        'occassion' => function(){
            $occassions = ['weddings', 'housewarmings', 'babyshower', 'dowry', 'houseparty'];
            return $occassions[rand(0,4)];
        },
        'quantity' => function(){
            return rand(2, 10);
        },
    ];
});
