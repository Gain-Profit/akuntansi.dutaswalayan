<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JurnalDetail;
use App\Models\Jurnal;
use App\Http\Requests;
use Gate;
use DB;

class JurnalController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('jurnal.index');
    }

    public function getJurnals($comp, $period, $hal, $random)
    {
        if (Gate::denies('show-unit', $comp)) {
            abort(404);
        }

        $tahun = substr($period, 0, 4);
        $bulan = substr($period, 4);

        $limit = 20;
        $offset = ($hal - 1) * $limit;
        
        $jurnals = Jurnal::where('perusahaan_id',$comp)
            ->whereMonth('tanggal',$bulan)
            ->whereYear('tanggal',$tahun)
            ->orderBy('tanggal','desc')
            ->offset($offset)
            ->limit($limit)
            ->get();

        return $jurnals;
    }

    public function getJurnalDetail($comp, $index, $random)
    {
        if (Gate::denies('show-unit', $comp)) {
            abort(404);
        }

        $hasil = DB::select(
            'SELECT jd.kiraan_id, kr.nama, jd.debit, jd.kredit FROM jurnal_details jd
            INNER JOIN kiraans kr ON jd.kiraan_id = kr.id AND kr.perusahaan_id = jd.perusahaan_id 
            WHERE jd.perusahaan_id = ? AND jd.jurnal_id = ? ORDER BY jd.urut',
            [$comp, $index]
        );
    
        return $hasil;
    }

    public function getBukuBesar($comp, $kiraan, $period, $random)
    {
        if (Gate::denies('show-unit', $comp)) {
            abort(404);
        }

        $tahun = substr($period, 0, 4);
        $bulan = substr($period, 4);

        $head = DB::select(
            'SELECT kiraan_id, saldo_awal, (saldo_awal + debit - kredit) AS saldo_akhir FROM jurnal_sejarahs 
             WHERE perusahaan_id = ? AND kiraan_id = ? AND tahun = ? AND bulan = ?',
             [$comp, $kiraan, $tahun, $bulan]
        );

        $body = DB::select(
            'SELECT jd.kiraan_id, ju.tanggal, ju.keterangan, jd.debit, jd.kredit
             FROM jurnals ju INNER JOIN jurnal_details jd 
             ON ju.id = jd.jurnal_id AND ju.perusahaan_id = jd.perusahaan_id
             WHERE jd.perusahaan_id =? AND jd.kiraan_id = ? AND YEAR(ju.tanggal) = ? AND MONTH(ju.tanggal) = ?
             ORDER BY ju.tanggal,ju.id',
             [$comp, $kiraan, $tahun, $bulan]
        );

        $hasil = array( "kiraan_id"   => isset($head[0]) ? $head[0]->kiraan_id   : 0,
                        "saldo_awal"  => isset($head[0]) ? $head[0]->saldo_awal  : 0,
                        "saldo_akhir" => isset($head[0]) ? $head[0]->saldo_akhir : 0,
                        "body" => $body 
                 );

        return $hasil;
    }

}
