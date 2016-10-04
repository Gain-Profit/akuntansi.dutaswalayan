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

}
