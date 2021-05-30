<?php


use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\StupenkaController;
use App\Http\Controllers\Api\UserController;
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
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/me', function (Illuminate\Http\Request $request) {
        return auth()->user();
    });
    Route::get('/user/{user}', [UserController::class, 'getUser']);

    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/stupenka', [StupenkaController::class, 'setStupenka']);
});

Route::get('/stupenki/{count?}', [StupenkaController::class, 'getStupenki']);
Route::get('/getCountStupenki', [StupenkaController::class, 'getCount']);
Route::get('/stupenka/{stupenka}', [StupenkaController::class, 'getStupenka']);
