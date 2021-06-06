<?php

use App\Models\City;
use App\Models\Stupenka;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class FillCitiesTableFromStupenki extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $cities = DB::table('stupenki')->select('city')->get()->unique()->pluck('city');
        foreach ($cities as $city) {
            $cityModel = City::create(['name' => $city]);
            Stupenka::where('city', $city)
                ->update(['city' => $cityModel->id]);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('cities')->truncate();
    }
}
