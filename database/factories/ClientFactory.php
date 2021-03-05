<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Client;
use Faker\Generator as Faker;

use Illuminate\Support\Collection;

$factory->define(Client::class, function (Faker $faker) {
    return [

    'nom' => $faker->firstName,
    'prenom' => $faker->lastName,
    'antenne' => $faker->company,
    'cni' => $faker->creditCardNumber,
    'date_naissance' => $faker->dateTimeThisCentury->format('Y-m-d'),
    'date_ouverture' =>  $faker->dateTimeThisCentury->format('Y-m-d'),
    'nom_association' => $faker->company,
    'nom_mandataire_1' =>  $faker->firstName.' '.$faker->lastName,
    'nom_mandataire_2' =>  $faker->firstName.' '.$faker->lastName,
    'nationalite' => $faker->country,
    'date_delivrance' => $faker->dateTimeThisCentury->format('Y-m-d'),
    'etat_civil' => Collection::make(['CELIBATAIRE','MARIE','DIVORCE','VEUF','VEUVE'])->random(),
    'nom_conjoint' => $faker->name,
    'profession' => $faker->jobTitle,
    'nom_employeur' => $faker->name,
    'lieu_activite' => $faker->streetAddress,
    'commune' => $faker->address,
    'quartier' => $faker->city,
    'rue'  => $faker->streetAddress,
    'address_no' => $faker->secondaryAddress,
    'boite_postal' => $facker->postcode,
    'telephone' => $faker->phoneNumber,
    'signateur_1_nom_prenom' =>  $faker->firstName.' '.$faker->lastName,
    'signateur_1_cni' => $faker->creditCardNumber,
    'signateur_1_tel' => $faker->phoneNumber,
    'signateur_2_nom_prenom' =>  $faker->firstName.' '.$faker->lastName,
    'signateur_2_cni' => $faker->creditCardNumber,
    'signateur_2_tel' => $faker->phoneNumber,
    'signateur_3_nom_prenom' =>  $faker->firstName.' '.$faker->lastName,
    'signateur_3_cni' => $faker->creditCardNumber,
    'signateur_3_tel' => $faker->phoneNumber
    ];
});
