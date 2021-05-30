<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Stupenka;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;


class StupenkaController extends Controller
{
    use ApiResponser;

    public function getStupenka(Stupenka $stupenka)
    {
        return response($stupenka);
    }

    public function getCount()
    {
        return Stupenka::all()->sum('count');
    }

    public function getStupenki(int $count = null)
    {
        return $count ? Stupenka::orderBy('id')->take($count) : Stupenka::all();
    }

    public function setStupenka(Request $request)
    {
        $stupenka = new Stupenka();
        $stupenka->user_id = auth()->id();
        $stupenka->location = $request->input('location');
        $stupenka->count = $request->input('count');
        $stupenka->save();

        return $this->success($stupenka, 'запись сохранена', 201);
    }
}
