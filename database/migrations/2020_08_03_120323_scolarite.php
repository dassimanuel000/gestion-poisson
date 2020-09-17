<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Scolarite extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scolarite', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('id_eleve');
            $table->double('montant');
            $table->string('motif')->nullable();
            $table->string('paiement')->nullable();
            $table->json('last_paiement')->nullable();
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
