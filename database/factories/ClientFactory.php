<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Client;
use Faker\Generator as Faker;

$factory->define(Client::class, function (Faker $faker) {
    return [
        //

        'nom' => $faker->firstName,
        'prenom' => $faker->lastName,
        'cni' => 'COPDI 2020',
        'date_naissance' => $faker->dateTimeThisCentury->format('Y-m-d')
    ];
});
