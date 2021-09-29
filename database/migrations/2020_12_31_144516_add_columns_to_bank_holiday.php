<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToBankHoliday extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bank_holiday', function (Blueprint $table) {
            $table->integer('year_id')->unsigned();
            $table->integer('type_id')->unsigned();

            $table->foreign('year_id')->references('id')->on('years')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('type_id')->references('id')->on('holiday_type')
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
        Schema::table('bank_holiday', function (Blueprint $table) {
            //
        });
    }
}
