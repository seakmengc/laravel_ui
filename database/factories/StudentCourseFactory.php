<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\StudentCourse;
use Faker\Generator as Faker;

$factory->define(StudentCourse::class, function (Faker $faker) {
    return [
        'user_id'=>$faker->numberBetween(1, 5),
        'course_id'=>$faker->numberBetween(1, 5),
    ];
});
