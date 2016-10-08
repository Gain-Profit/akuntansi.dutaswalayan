<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Gate;
use DB;

class KiraanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('kiraan.index');
    }

    public function getKiraan($comp, $random)
    {
        if (Gate::denies('show-unit', $comp)) {
            abort(404);
        }

        $hasil = DB::select(
            'SELECT kr.id, kr.nama AS nama_kiraan, sk.nama AS nama_kelas_sub, kl.nama AS nama_kelas  
            FROM kiraans kr  
            INNER JOIN kelas_subs sk ON kr.kelas_sub_id = sk.id 
            INNER JOIN kelas kl ON sk.kelas_id = kl.id 
            WHERE kr.perusahaan_id = ?',[$comp]
        );

        return $hasil;
    }

    public function getKiraanSimple($comp, $random){
        if (Gate::denies('show-unit', $comp)) {
            abort(404);
        }

        $hasil = DB::select(
            'SELECT kr.id, kr.nama FROM kiraans kr WHERE kr.perusahaan_id = ?',[$comp]
        );

        return $hasil;
    }
}
