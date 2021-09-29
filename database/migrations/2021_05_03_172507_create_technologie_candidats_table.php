<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTechnologieCandidatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('technologie_candidats', function (Blueprint $table) {
            $table->id();
            $table->integer('technologie_id')->references('id')->on('Technologies');
            $table->integer('candidats_id')->references('id')->on('Candidat');
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
        Schema::dropIfExists('technologie_candidats');
    }
}
