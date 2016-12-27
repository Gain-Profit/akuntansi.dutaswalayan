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

Auth::routes();

Route::get('/', 'HomeController@index');

Route::get('/asset', 'AssetController@index');

Route::get('/awal', 'LaporanController@awal');

Route::get('/kiraan', 'KiraanController@index');

Route::get('/balance', 'LaporanController@balance');

Route::get('/neraca', 'LaporanController@neraca');

Route::get('/jurnal','JurnalController@index');

Route::get('/laba', 'LaporanController@laba');

Route::get('/buku-besar', 'LaporanController@bukuBesar');

Route::group(['prefix' => 'api'], function () {
    Route::get('/kiraan/{comp}/{random}', 'KiraanController@getKiraan');

    Route::get('/kiraan-simple/{comp}/{random}', 'KiraanController@getKiraanSimple');
    
    Route::get('/awal/{comp}/{period}/{random}', 'SejarahController@getSaldoAwal');

    Route::get('/balance/{comp}/{period}/{random}', 'SejarahController@getBalance');

    Route::get('/neraca/{comp}/{period}/{random}', 'SejarahController@getNeraca');

    Route::get('/laba/{comp}/{period}/{random}', 'SejarahController@getLaba');

    Route::get('/perusahaans/{random}', 'PerusahaanController@getPerusahaans');

    Route::get('/jurnal/{comp}/{period}/{hal}/{random}','JurnalController@getJurnals');

    Route::get('/jurnal-detail/{comp}/{index}/{random}','JurnalController@getJurnalDetail');

    Route::get('/buku-besar/{comp}/{kiraan}/{period}/{random}', 'JurnalController@getBukuBesar');

    Route::get('/asset/{comp}/{random}', 'AssetController@getAsset');
});