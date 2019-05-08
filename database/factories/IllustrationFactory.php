<?php
use Faker\Generator as Faker;
use App\Illustration;

$factory->define(Illustration::class, function (Faker $faker) {
    return [
        'title' => $faker->text($maxNbChars = 50),
        'description' => $faker->text($maxNbChars = 100),
        'image' => str_replace('storage/app/public/','', $faker->image('storage/app/public/illustrations')),
    ];
});
