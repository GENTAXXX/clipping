<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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

Route::get('admin-page', function () {
    return 'Halaman untuk Admin';
})->middleware('role:admin')->name('admin.page');

Route::get('contributor-page', function () {
    return 'Halaman untuk Contributor';
})->middleware('role:contributor')->name('contributor.page');

Route::get('editor-page', function () {
    return 'Halaman untuk Editor';
})->middleware('role:editor')->name('editor.page');

Route::get('/login', 'LoginController@getLogin')->middleware('guest');
Route::post('/login', 'LoginController@postLogin');
Route::get('/logout', 'LoginController@logout');;

Route::get('/admin', function () {
    return view('admin');
})->middleware('auth:admin');

Route::get('/user', function () {
    return view('user');
})->middleware('auth:user');

Route::get('/home', 'HomeController@index')->name('home');
Route::get('upload', 'APIController@upload');
Route::post('add', 'ProjectAPI@ddContributorAndEditor');

Route::get('email', 'JobController@processQueue');

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