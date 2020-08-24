<?php

use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('upload', 'APIController@upload');

Route::group(['middleware'], function () {
    Route::get('news', 'NewsAPI@index');
    Route::get('news/{id}', 'NewsAPI@show');
    Route::post('news', 'NewsAPI@store');
    Route::put('news/{id}', 'NewsAPI@update');
    Route::delete('news/{id}', 'NewsAPI@destroy');
});

Route::group(['middleware'], function () {
    Route::get('projects', 'ProjectAPI@index');
    Route::get('project/{id}', 'ProjectAPI@show');
    Route::post('project', 'ProjectAPI@store');
    Route::put('project/{id}', 'ProjectAPI@update');
    Route::delete('project/{id}', 'ProjectAPI@destroy');
});

Route::group(['middleware'], function () {
    Route::get('medias', 'MediasAPI@index');
    Route::get('media/{id}', 'MediasAPI@show');
    Route::post('media', 'MediasAPI@store');
    Route::put('media/{id}', 'MediasAPI@update');
    Route::delete('media/{id}', 'MediasAPI@destroy');
});

Route::group(['middleware'], function () {
    Route::get('languages', 'LanguagesAPI@index');
    Route::get('language/{id}', 'LanguagesAPI@show');
    Route::post('language', 'LanguagesAPI@store');
    Route::put('language/{id}', 'LanguagesAPI@update');
    Route::delete('language/{id}', 'LanguagesAPI@destroy');
});

Route::group(['middleware'], function () {
    Route::get('categories', 'CategoriesAPI@index');
    Route::get('categories/{id}', 'CategoriesAPI@show');
    Route::post('categories', 'CategoriesAPI@store');
    Route::put('categories/{id}', 'CategoriesAPI@update');
    Route::delete('categories/{id}', 'CategoriesAPI@destroy');
});


