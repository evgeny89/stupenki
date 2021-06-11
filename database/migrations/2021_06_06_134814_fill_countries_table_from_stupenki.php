<?php

use App\Models\Country;
use App\Models\Stupenka;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class FillCountriesTableFromStupenki extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $cities = DB::table('stupenki')->select('country')->get()->unique()->pluck('country');
        foreach ($cities as $city) {
            $cityModel = Country::create(['name' => $city]);
            Stupenka::where('country', $city)
                ->update(['country' => $cityModel->id]);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('countries')->truncate();
    }
}
