<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Enseignant extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enseignant', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name_enseignant');
            $table->string('id_classe')->nullable();
            $table->string('age');
            $table->string('matricule');
            $table->string('tel_enseignant');
            $table->string('adresse_enseignant');
            $table->string('salaire')->nullable();
            $table->json('description')->nullable();
            $table->string('sexe');
            $table->string('tel_urgence')->nullable();
            $table->string('image')->nullable();
            $table->json('pret')->nullable();
            $table->json('remboursement')->nullable();
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
