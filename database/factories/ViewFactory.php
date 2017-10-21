<?php

use Carbon\Carbon;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\View::class, function (Faker $faker) {
    $count = $faker->numberBetween(4, 20);

    return [
        'timestamp' => Carbon::now(),
        'count' => $count,
        'uniques' => $faker->numberBetween($count, 30)
    ];
});
