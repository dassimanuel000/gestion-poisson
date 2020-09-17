<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Eleve extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eleve', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('matricule');
            $table->string('name_eleve');
            $table->string('prenom_eleve');
            $table->string('id_classe')->nullable();
            $table->string('lieu_naissance');
            $table->string('age');
            $table->string('name_parent');
            $table->string('tel_parent');
            $table->string('adresse');
            $table->string('sexe');
            $table->string('name_tuteur')->nullable();
            $table->string('tel_urgence');
            $table->string('image')->nullable();
            $table->string('inscription')->nullable();
            $table->string('tranche1')->nullable();
            $table->string('tranche2')->nullable();
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
