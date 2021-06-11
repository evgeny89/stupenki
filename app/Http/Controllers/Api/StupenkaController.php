<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SetStupenkaRequest;
use App\Models\City;
use App\Models\Country;
use App\Models\Stupenka;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;


class StupenkaController extends Controller
{
    use ApiResponser;

    public function getStupenka(Stupenka $stupenka)
    {
        return  $this->success($stupenka->load('comments.user', 'user'));
    }

    public function getCount()
    {
        return Stupenka::all()->sum('count');
    }

    public function getStupenki(int $count = null)
    {
        return $count ? Stupenka::inRandomOrder()->take($count) : Stupenka::all();
    }

    public function setStupenka(SetStupenkaRequest $request)
    {
        $country = Country::firstOrCreate(['name' => $request->input('country')]);
        $city = City::firstOrCreate(['name' => $request->input('city')]);

        $stupenka = new Stupenka();
        $imageName = $stupenka->uploadImage($request->file('image'));
        $stupenka->image = $imageName;
        $stupenka->user_id = auth()->id();
        $stupenka->country_id = $country->id;
        $stupenka->city_id = $city->id;
        $stupenka->name = $request->input('name');
        $stupenka->count = $request->input('count');
        $stupenka->save();

        return $this->success($stupenka, 'запись сохранена', 201);
    }
}
