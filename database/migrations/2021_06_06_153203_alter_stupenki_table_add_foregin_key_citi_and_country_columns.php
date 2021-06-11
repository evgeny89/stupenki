<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterStupenkiTableAddForeginKeyCitiAndCountryColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('stupenki') && Schema::hasColumn('stupenki', 'city_id')) {
            Schema::table('stupenki', function (Blueprint $table) {
                $table->foreign('city_id')->references('id')->on('users');
            });
        }

        if (Schema::hasTable('stupenki') && Schema::hasColumn('stupenki', 'country_id')) {
            Schema::table('stupenki', function (Blueprint $table) {
                $table->foreign('country_id')->references('id')->on('users');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasTable('stupenki') && Schema::hasColumn('stupenki', 'city_id')) {
            Schema::table('stupenki', function (Blueprint $table) {
                $table->dropForeign('stupenki_city_id_foreign');
            });
        }

        if (Schema::hasTable('stupenki') && Schema::hasColumn('stupenki', 'country_id')) {
            Schema::table('stupenki', function (Blueprint $table) {
                $table->dropForeign('stupenki_country_id_foreign');
            });
        }
    }
}
