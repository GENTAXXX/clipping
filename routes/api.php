<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware'], function () {
    Route::get('news','NewsAPI@index'); //get all news
    Route::get('news/{id}','NewsAPI@show'); //get a news
    Route::get('news/category/{kategori}','NewsAPI@searchByGolongan');
    Route::post('news','NewsAPI@store'); //add news
    Route::put('news/{id}','NewsAPI@update'); //update news
    Route::delete('news/{id}','NewsAPI@destroy'); //delete news
});