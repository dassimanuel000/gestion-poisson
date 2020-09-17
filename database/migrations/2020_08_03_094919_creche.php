<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Creche extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('creche', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('prenom');
            $table->string('age');
            $table->string('name_parent');
            $table->string('tel_parent');
            $table->string('adresse')->nullable();
            $table->string('sexe');
            $table->string('lieu_naissance', 250)->nullable()->default('text');
            $table->string('tel_urgence');
            $table->string('image')->nullable();
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
