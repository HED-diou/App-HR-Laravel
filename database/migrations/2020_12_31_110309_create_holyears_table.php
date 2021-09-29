<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHolyearsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {


        Schema::create('holyears', function(Blueprint $table) {
            $table->bigIncrements('id');

            $table->integer('holiday_id')->unsigned();

            $table->foreign('holiday_id')->references('id')->on('bank_holiday')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->integer('year_id')->unsigned();
            $table->foreign('year_id')->references('id')->on('years')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('holyears');
    }
}

