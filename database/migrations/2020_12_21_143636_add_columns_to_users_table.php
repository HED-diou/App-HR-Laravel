<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('lastname')->nullable();
            $table->date('hiredate')->nullable();
            $table->float('balance')->nullable();
            $table->string('tel')->nullable();
            $table->string('address')->nullable();
            $table->date('birthdate')->nullable();
            $table->string('cin')->nullable();
            $table->string('cnss')->nullable();
            $table->integer('manager')->nullable();	
            $table->integer('admin')->nullable();
            $table->integer('statut')->nullable();
            $table->date('connected_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('lastname');
            $table->dropColumn('hiredate');
            $table->dropColumn('balance');
            $table->dropColumn('tel');
            $table->dropColumn('address');
            $table->dropColumn('birthdate');
            $table->dropColumn('cin');
            $table->dropColumn('cnss');
            $table->dropColumn('manager');
            $table->dropColumn('admin');
            $table->dropColumn('statut');
            $table->dropColumn('connected_at');

        });
    }
}
