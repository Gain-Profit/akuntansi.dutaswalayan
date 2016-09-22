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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::get('/neraca', function () {
    return App\Models\JurnalSejarah::all();
});

Route::get('/neraca/{comp}/{period}', function ($comp,$period) {
    $tahun = substr($period,0,4);
    $bulan = substr($period,5);

    $hasil = DB::select(
        'SELECT jh.perusahaan_id, kr.nama AS nama_kiraan, sk.nama AS nama_kelas_sub, kl.nama AS nama_kelas, kl.gol, 
        IF(kl.gol = "DB",(jh.saldo_awal + jh.debit - jh.kredit),-(jh.saldo_awal + jh.debit - jh.kredit)) AS saldo_ahir 
        FROM jurnal_sejarahs jh 
        INNER JOIN kiraans kr ON (jh.kiraan_id = kr.id AND jh.perusahaan_id = kr.perusahaan_id) 
        INNER JOIN kelas_subs sk ON kr.kelas_sub_id = sk.id 
        INNER JOIN kelas kl ON sk.kelas_id = kl.id 
        WHERE jh.perusahaan_id = ? AND jh.tahun = ? AND jh.bulan = ? AND kl.jenis = "NR"',
        [$comp,$tahun,$bulan]
    );
    
    return $hasil;

    // return App\Models\JurnalSejarah::where('perusahaan_id',$comp)
    // ->where('tahun',$tahun)
    // ->where('bulan',$bulan)
    // ->get();
});

Route::get('/laba/{comp}/{period}', function ($comp,$period) {
    $tahun = substr($period,0,4);
    $bulan = substr($period,5);

    $hasil = DB::select('SELECT jh.perusahaan_id, kr.nama AS nama_kiraan, sk.nama AS nama_kelas_sub, 
    kl.nama AS nama_kelas, kl.gol, IF(kl.gol = "DB",(jh.debit - jh.kredit),-(jh.debit - jh.kredit)) AS saldo_ahir 
    FROM jurnal_sejarahs jh 
    INNER JOIN kiraans kr ON (jh.kiraan_id = kr.id AND jh.perusahaan_id = kr.perusahaan_id) 
    INNER JOIN kelas_subs sk ON kr.kelas_sub_id = sk.id 
    INNER JOIN kelas kl ON sk.kelas_id = kl.id 
    WHERE jh.perusahaan_id = ? AND jh.tahun = ? AND jh.bulan = ? AND kl.jenis = "LR"',
    [$comp,$tahun,$bulan]);
    
    return $hasil;
});