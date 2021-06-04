<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterStupenkiTableAddForeignKeyForUserIdColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('stupenki') && Schema::hasColumn('stupenki', 'user_id')) {
            Schema::table('stupenki', function (Blueprint $table) {
                $table->foreign('user_id')->references('id')->on('users');
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
        if (Schema::hasTable('stupenki') && Schema::hasColumn('stupenki', 'user_id')) {
            Schema::table('stupenki', function (Blueprint $table) {
                $table->dropForeign('stupenki_user_id_foreign');
            });
        }
    }
}
