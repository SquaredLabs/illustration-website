<?php
use Faker\Generator as Faker;
use App\Request;
use Carbon\Carbon;


$factory->define(Request::class, function (Faker $faker) {
    $now = Carbon::now();
    // 0: New, 1: Form 2 done and waiting,  2: Form 2 signed, 3: Completed or cancelled
    $status = rand(0, 3);
    return [
        'cover' => rand(0, 1) == 1,
        'status' => $status,
        'description' => $faker->text($maxNbChars = 100),
        'deadline' => rand(0, 1) == 1 ? $now->copy()->addDays(rand(1,60)) : null,
        'journal' => rand(0, 1) == 1 ?  $faker->text($maxNbChars = 10)  :  null,
        'kfs' =>  rand(1000000, 9999999),
        'requestee' => App\User::all()->random()->id,
        'illustrator' => $status > 0 ? App\User::where('admin', true)->inRandomOrder()->first()->id : null,
    ];
});
