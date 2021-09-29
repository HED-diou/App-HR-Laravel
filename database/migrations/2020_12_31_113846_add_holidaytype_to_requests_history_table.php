<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddHolidaytypeToRequestsHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('requests_history', function (Blueprint $table) {
            $table->integer('holidaytype')->unsigned();
            $table->foreign('holidaytype')->references('id')->on('holidays');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('requests_history', function (Blueprint $table) {
            //
        });
    }
}
