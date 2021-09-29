<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requests', function (Blueprint $table) {
          
            $table->id();
            $table->date('start_date');
            $table->date('end_date');
            $table->float('dayscount');
            $table->date('created_at');
            $table->tinyInteger('holidaytype');
            $table->string('admincomment')->nullable();
            $table->string('comment')->nullable();
            $table->tinyInteger('archived')->nullable();
            $table->tinyInteger('leaving_at_evening')->nullable();
            $table->tinyInteger('coming_at_evening')->nullable();
            $table->integer('statut')->unsigned();
            $table->foreign('statut')->references('id')->on('statutes');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('requests');
    }
}
