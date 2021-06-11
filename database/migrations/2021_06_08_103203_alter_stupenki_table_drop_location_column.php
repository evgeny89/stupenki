<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterStupenkiTableDropLocationColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('stupenki') && Schema::hasColumn('stupenki', 'location')) {
            Schema::table('stupenki', function (Blueprint $table) {
                $table->dropColumn('location');
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
        if (Schema::hasTable('stupenki') && !Schema::hasColumn('stupenki', 'location')) {
            Schema::table('stupenki', function (Blueprint $table) {
                $table->string('location')->nullable();
            });
        }
    }
}
