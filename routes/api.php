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
    Route::get('news/all', 'APIController@getAllNewsbyProjectAndStatus'); //get news by project id and status
    Route::get('news/{id}','APIController@getNewsById'); //get a news *
    Route::post('news','APIController@addNews'); //add news *
    Route::put('news/{id}','APIController@updateNews'); //update news *
    Route::delete('news/{id}','APIController@deleteNewsById'); //delete news
    Route::get('search', 'APIController@searchNewsByTitle'); //search news by title
    Route::get('count', 'APIController@countNews'); //count news
    Route::put('status/{id}', 'APIController@updateStatus');
});


// Route::post('upload/proses', 'APIController@uploadProses');
Route::post('login', 'APIController@login'); 
Route::get('projects', 'APIController@getListProjects'); //get All Projects
Route::get('medias', 'APIController@getListMedias'); //get All Medias
Route::get('language/{id}', 'APIController@getLanguage'); //get an Language
Route::get('languages', 'APIController@getListLanguages'); //get All Languages
Route::get('categories', 'APIController@getListCategories'); //get All Categories
Route::get('keywords/{id}', 'APIController@getKeywordsByNewsId');
