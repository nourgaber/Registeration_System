<?php

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::group(['prefix' => 'auth/users', 'middleware' => 'api.guard:api'], function () {
    Route::post('register', 'App\Http\Controllers\AuthController@register');
    Route::post('login', 'App\Http\Controllers\AuthController@login');
    Route::post('refresh ', 'App\Http\Controllers\AuthController@refresh');
    Route::post('logout ', 'App\Http\Controllers\AuthController@logout');
    Route::get('user ', 'App\Http\Controllers\AuthController@user');
});
Route::group(['prefix' => 'auth/admin', 'middleware' => 'api.guard:admin-api'], function () {
    Route::post('register', 'App\Http\Controllers\AuthController@adminRegister');
    Route::post('login', 'App\Http\Controllers\AuthController@login');
    Route::post('refresh ', 'App\Http\Controllers\AuthController@refresh');
    Route::post('logout ', 'App\Http\Controllers\AuthController@logout');
    Route::get('user ', 'App\Http\Controllers\AuthController@user');
});
