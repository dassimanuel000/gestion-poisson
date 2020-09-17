<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Classe extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('classe', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name_classe');
            $table->string('initial_classe')->unique()->nullable();
            $table->string('titulaire_classe')->nullable();
            $table->double('pension')->nullable();
            $table->json('list_eleve')->nullable();
            $table->double('nbre_eleve')->nullable();
            $table->json('list_livre')->nullable();
            $table->json('list_cahier')->nullable();
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
