<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequestsHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requests_history', function (Blueprint $table) {
            $table->id();
            $table->date('start_date');
            $table->date('end_date');
            $table->float('dayscount');
            $table->date('updated_at');
            $table->tinyInteger('holidaytype');
            $table->string('admincomment')->nullable();
            $table->string('comment')->nullable();
            $table->tinyInteger('leaving_at_evening')->nullable();
            $table->tinyInteger('coming_at_evening')->nullable();
            $table->tinyInteger('latest_action')->unsigned()->nullable();
            $table->foreign('latest_action')->references('id')->on('actions');
            $table->integer('statut')->unsigned();
            $table->foreign('statut')->references('statut')->on('requests');
            $table->integer('requester')->unsigned();
            $table->foreign('requester')->references('id')->on('users');
            $table->integer('admin')->unsigned()->nullable();
            $table->foreign('admin')->references('id')->on('users');
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
