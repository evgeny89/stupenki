<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterStupenkiTableModifyCitiAndCountryColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('stupenki', function (Blueprint $table) {
            $table->bigInteger('city')->unsigned()->nullable()->change();
            $table->bigInteger('country')->unsigned()->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('stupenki', function (Blueprint $table) {
            $table->string('city')->nullable()->change();
            $table->string('country')->nullable()->change();
        });
    }
}
