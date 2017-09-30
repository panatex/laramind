<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\Ordini::class, function (Faker $faker) {
    return [
        'data_ordine' => $faker->date,
        'importo' => $faker->randomNumber(5),
        //anagrafica_id la popolo direttamente al volo nel seeder passando i dati
        'stati_ordine_id' =>1
    ];
});