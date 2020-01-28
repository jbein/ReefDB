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

Route::get('/data', 'DataController@showAll');

Route::get('/stats/{stat}', 'StatsController@show');

Route::get('/', function () {
    return view('data');
});



