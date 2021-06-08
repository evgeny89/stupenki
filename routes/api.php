<?php


use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\SearchController;
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
/**
 * роут для регистрации
 * in: name, email, password
 * out: status, message, data
 */
Route::post('/register', [AuthController::class, 'register']);

/**
 * роут для авторизации
 * in: email, password
 * out: status, message, data
 */
Route::post('/login', [AuthController::class, 'login']);

/**
 *  внутри группы доступ только авторизованным пользователям.
 */
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/me', [UserController::class, 'getMe']);
    Route::get('/user/{user}', [UserController::class, 'getUser']);

    Route::post('/logout', [AuthController::class, 'logout']);

    Route::get('/search_country', [SearchController::class, 'searchCountryAutocomplete']);
    Route::get('/search_city', [SearchController::class, 'searchCityAutocomplete']);
    Route::post('/stupenka', [StupenkaController::class, 'setStupenka']);
});

Route::get('/stupenki/{count?}', [StupenkaController::class, 'getStupenki']);
Route::get('/getCountStupenki', [StupenkaController::class, 'getCount']);
Route::get('/stupenka/{stupenka}', [StupenkaController::class, 'getStupenka']);
Route::get('/search', [SearchController::class, 'searchAllAutocomplete']);
Route::get('/get_by_search', [SearchController::class, 'getStupenkiToSearchString']);
