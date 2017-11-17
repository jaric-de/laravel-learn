<?php

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


Route::get('games/test', 'GamesController@test');


Route::get('/', 'GamesController@index');
Route::get('/games', 'GamesController@index')->name('games_list');
Route::get('games/create', 'GamesController@create');
Route::post('games/store', 'GamesController@store');
Route::get('games/{id}', 'GamesController@show');
Route::get('games/edit/{id}', 'GamesController@edit');
Route::post('games/update/{id}', 'GamesController@update');
Route::get('games/delete/{id}', 'GamesController@destroy');
