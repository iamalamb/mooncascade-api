<?php

use Mooncascade\Entities\Athlete;
use Faker\Generator;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(Athlete::class, function (Generator $faker, array $attributes) {

    $maxAge = (isset($attributes['max_age'])) ? $attributes['max_age'] : 75;
    $minAge = (isset($attributes['min_age'])) ? $attributes['min_age'] : 18;

    return [
        'name' => $faker->name,
        'code' => $faker->unique()->uuid,
        'dateOfBirth' => $faker->dateTimeBetween('-' .  $maxAge . ' years', '-' .  $minAge . ' years')
    ];
});
