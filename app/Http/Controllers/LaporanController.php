<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class LaporanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function awal() 
    {
        return view('laporan.neraca')
            ->with('jenis','awal')
            ->with('label','Saldo Awal');
    }
    
    public function neraca() 
    {
        return view('laporan.neraca')
            ->with('jenis','neraca')
            ->with('label','Neraca');
    }

    public function laba()
    {
        return view('laporan.laba');
    }

    public function balance()
    {
        return view('laporan.balance');
    }
}
