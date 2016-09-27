<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Auth::routes();

Route::get('/', 'HomeController@index');

Route::get('/awal', 'LaporanController@awal');

Route::get('/kiraan', 'KiraanController@index');

Route::get('/balance', 'LaporanController@balance');

Route::get('/neraca', 'LaporanController@neraca');

Route::get('/laba', 'LaporanController@laba');

Route::group(['prefix' => 'api'], function () {
    Route::get('/kiraan/{comp}', 'KiraanController@getKiraan');

    Route::get('/awal/{comp}/{period}', 'SejarahController@getSaldoAwal');

    Route::get('/balance/{comp}/{period}', 'SejarahController@getBalance');

    Route::get('/neraca/{comp}/{period}', 'SejarahController@getNeraca');

    Route::get('/laba/{comp}/{period}', 'SejarahController@getLaba');

    Route::get('/perusahaans', 'PerusahaanController@getPerusahaans');
});