<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Identity;
use Faker\Generator as Faker;

$factory->define(Identity::class, function (Faker $faker) {
    return [
        'user_id'=>$faker->unique()->numberBetween(1, 5),
        'first_name'=>$faker->firstName,
        'last_name'=>$faker->lastName,
        'dob'=>$faker->dateTimeThisDecade,
        'email'=>$faker->safeEmail,
        'phone_number'=>'0' . $faker->randomNumber(9),
    ];
});
