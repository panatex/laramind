<?php

use Faker\Generator as Faker;

/*$factory->define(Model::class, function (Faker $faker) {
    return [
        //
    ]; */

$factory->define(\App\Models\AnagraficaClienti::class, function (Faker $faker) {
    /*
     * il faker ha già generato i dati prima del return in memoria
     * quinid posso memorizzare l'immagine chiamando prima del return e nel return metterci quello che deve essere scritto nel db da parte del databaseSeeder
     */
    $immagine = $faker->image(public_path().DIRECTORY_SEPARATOR.config('laramind.LogoFolder'));
    return [
        'nome' => $faker->name,
        'cognome' => $faker->lastName,
        'email' => $faker->email,
        //tolgo il public path dal db
        'logo' => str_replace(public_path(),'',$immagine),
        'data_contatto' => $faker->date(),
        'telefono' =>$faker->phoneNumber,
    ];
});
