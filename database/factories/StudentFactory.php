<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Student;
use Faker\Generator as Faker;

$factory->define(Student::class, function (Faker $faker) {
    return [
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'age' => $faker->randomNumber(2),
        'date_naissance' => $faker->dateTimeThisCentury->format('Y-m-d')
    ];
});
