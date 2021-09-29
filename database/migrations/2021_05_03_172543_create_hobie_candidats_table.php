<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHobieCandidatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hobie_candidats', function (Blueprint $table) {
            $table->id();
            $table->integer('Hobie_id')->references('id')->on('Hobies');
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
        Schema::dropIfExists('hobie_candidats');
    }
}
