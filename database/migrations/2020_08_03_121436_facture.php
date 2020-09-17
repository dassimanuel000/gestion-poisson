<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Facture extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('facture_emis', function (Blueprint $table) {
            $table->bigIncrements('idfacture_emis');
            $table->string('identifiantFacture');
            $table->string('name_eleve');
            $table->decimal('id_eleve');
            $table->string('motif');
            $table->double('montant');
            $table->json('last_montant');
            $table->double('totalFacture');
            $table->longText('autre');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
