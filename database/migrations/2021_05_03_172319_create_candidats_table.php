<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCandidatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('candidats', function (Blueprint $table) {
            $table->id();
            $table->string('Nom',50);
            $table->string('Prenom',50);
            $table->integer('Sexe')->nullable();
            $table->string('CIN',6)->nullable();
            $table->date('DateNaissance')->nullable();
            $table->integer('StatutFamiliale')->nullable();
            $table->string('Ville',50)->nullable();
            $table->string('Adresse',255)->nullable();
            $table->string('phone',15)->nullable();
            $table->string('email',50);
            $table->integer('NombreDanneesDexperience')->nullable();
            $table->double('PretentionSalariale')->nullable();
            $table->integer('Travailleactuellement')->nullable();
            $table->date('EnArretDepuis')->nullable();
            $table->string('CV',255)->nullable();
            $table->string('LettreMotivation',255)->nullable();
            $table->date('DateCandidature')->nullable();
            $table->integer('Appreciation')->nullable();
            $table->integer('motife')->nullable();
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
        Schema::dropIfExists('candidats');
    }
}
