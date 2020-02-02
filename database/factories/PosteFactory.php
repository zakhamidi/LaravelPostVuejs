<?php

use Faker\Generator as Faker;

$factory->define(App\Poste::class, function (Faker $faker) {
    return [
        'title' => $faker->text(50),
        'body'  => $faker->text(200)
    ];
});
