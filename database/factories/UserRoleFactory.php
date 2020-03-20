<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\UserRole;
use Faker\Generator as Faker;

$factory->define(UserRole::class, function (Faker $faker) {
    return [
        'user_id'=>$faker->numberBetween(1, 5),
        'role_id'=>$faker->numberBetween(1, 5),
    ];
});
