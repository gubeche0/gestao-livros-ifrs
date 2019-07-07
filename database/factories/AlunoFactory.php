<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Aluno;
use Faker\Generator as Faker;

$factory->define(Aluno::class, function (Faker $faker) {
    return [
        'nome' => $faker->name,
        'matricula' => $faker->unique()->ean13(),
        'email' => $faker->unique()->safeEmail,
        'curso_id' => $faker->numberBetween(1, 4),
    ];
});