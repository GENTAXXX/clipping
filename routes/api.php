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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware'], function () {
    Route::get('news','NewsAPI@index'); //get all news
    Route::get('news/all', 'NewsAPI@getAllProjectByStatus');
    Route::get('news/{id}','NewsAPI@show'); //get a news
    Route::get('news/category/{kategori}','NewsAPI@searchByGolongan');
    Route::post('news','NewsAPI@store'); //add news
    Route::put('news/{id}','NewsAPI@update'); //update news
    Route::delete('news/{id}','NewsAPI@destroy'); //delete news
});

Route::group(['middleware'], function () {
    Route::get('projects', 'ProjectAPI@index');
    Route::get('projects/{id}', 'ProjectAPI@show'); //get a news
    //Route::get('projects/category/{kategori}', 'ProjectAPI@searchByGolongan');
    Route::post('projects', 'ProjectAPI@store'); //add news
    Route::put('projects/{id}', 'ProjectAPI@update'); //update news
    Route::delete('projects/{id}', 'ProjectAPI@destroy'); //delete news
});

Route::get('languages', 'LanguagesAPI@index');