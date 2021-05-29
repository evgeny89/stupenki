<?php

use App\Http\Controllers\Api\StupenkaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});
Route::apiResource('/user', \App\Models\User::class);
Route::apiResource('/stupenka', StupenkaController::class);
Route::get('/stupenki', function () {
    return new \App\Http\Resources\StupenkaCollection(\App\Models\Stupenka::all());
});


