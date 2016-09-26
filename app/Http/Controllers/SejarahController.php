<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

use App\Http\Requests;

class SejarahController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getSaldoAwal($comp, $period) {
        $tahun = substr($period, 0, 4);
        $bulan = substr($period, 4);

        $hasil = DB::select(
            'SELECT jh.perusahaan_id, jh.kiraan_id, kr.nama AS nama_kiraan, sk.nama AS nama_kelas_sub, 
            kl.nama AS nama_kelas, kl.gol, IF(kl.gol = "DB", jh.saldo_awal, -jh.saldo_awal) AS saldo 
            FROM jurnal_sejarahs jh 
            INNER JOIN kiraans kr ON (jh.kiraan_id = kr.id AND jh.perusahaan_id = kr.perusahaan_id) 
            INNER JOIN kelas_subs sk ON kr.kelas_sub_id = sk.id 
            INNER JOIN kelas kl ON sk.kelas_id = kl.id 
            WHERE jh.perusahaan_id = ? AND jh.tahun = ? AND jh.bulan = ? AND kl.jenis = "NR"',
            [$comp, $tahun, $bulan]
        );
    
        return $hasil;
    }

    public function getBalance($comp, $period)
    {
        $tahun = substr($period, 0, 4);
        $bulan = substr($period, 4);

        $hasil = DB::select(
            'SELECT jh.kiraan_id, kr.nama AS nama_kiraan, jh.debit, jh.kredit
            FROM jurnal_sejarahs jh 
            INNER JOIN kiraans kr ON (jh.kiraan_id = kr.id AND jh.perusahaan_id = kr.perusahaan_id) 
            WHERE jh.perusahaan_id = ? AND jh.tahun = ? AND jh.bulan = ?',
            [$comp, $tahun, $bulan]
        );
    
        return $hasil;
    }
    
    public function getNeraca($comp, $period)
    {
        $tahun = substr($period, 0, 4);
        $bulan = substr($period, 4);

        $hasil = DB::select(
            'SELECT jh.perusahaan_id, jh.kiraan_id, kr.nama AS nama_kiraan, sk.nama AS nama_kelas_sub, kl.nama AS nama_kelas, kl.gol, 
            IF(kl.gol = "DB",(jh.saldo_awal + jh.debit - jh.kredit),-(jh.saldo_awal + jh.debit - jh.kredit)) AS saldo 
            FROM jurnal_sejarahs jh 
            INNER JOIN kiraans kr ON (jh.kiraan_id = kr.id AND jh.perusahaan_id = kr.perusahaan_id) 
            INNER JOIN kelas_subs sk ON kr.kelas_sub_id = sk.id 
            INNER JOIN kelas kl ON sk.kelas_id = kl.id 
            WHERE jh.perusahaan_id = ? AND jh.tahun = ? AND jh.bulan = ? AND kl.jenis = "NR"',
            [$comp, $tahun, $bulan]
        );
    
        return $hasil;
    }

    public function getLaba($comp, $period)
    {
        $tahun = substr($period, 0, 4);
        $bulan = substr($period, 4);

        $hasil = DB::select(
            'SELECT jh.perusahaan_id, jh.kiraan_id, kr.nama AS nama_kiraan, sk.nama AS nama_kelas_sub, 
            kl.nama AS nama_kelas, kl.gol, -(jh.debit - jh.kredit) AS saldo_akhir 
            FROM jurnal_sejarahs jh 
            INNER JOIN kiraans kr ON (jh.kiraan_id = kr.id AND jh.perusahaan_id = kr.perusahaan_id) 
            INNER JOIN kelas_subs sk ON kr.kelas_sub_id = sk.id 
            INNER JOIN kelas kl ON sk.kelas_id = kl.id 
            WHERE jh.perusahaan_id = ? AND jh.tahun = ? AND jh.bulan = ? AND kl.jenis = "LR"',
            [$comp, $tahun, $bulan]
        );
    
        return $hasil;
    }
}
