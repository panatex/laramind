<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        //richiamo il faker
        //secondo parametro numero record da creare
        //
        factory(\App\Models\AnagraficaClienti::class, 10)->create()->each(function ($cliente){
            Log::info($cliente->id);
            //passo alla facrtory dell'oridne tramite la create id che deve essere assegnato per poter agganciare i dati tra anagrafica ed ordine usando i nomi delle colonne
            factory(\App\Models\Ordini::class,5)->create(['anagrafica__clienti_id' => $cliente->id]);
        });

    }
}
