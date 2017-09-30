<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModLogoToAnagraficaClienti extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('anagrafica_clienti', function (Blueprint $table) {
            //quando si fa un cambio basta inserire le proprietà che si vogliono cambiare e poi dare il change
            $table->string('logo',255)->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('anagrafica_clienti', function (Blueprint $table) {
            //
        });
    }
}
