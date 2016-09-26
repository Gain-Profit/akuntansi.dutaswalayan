<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;

class PerusahaanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getPerusahaans()
    {
        return DB::select('SELECT p.id, p.nama 
            FROM perusahaans p 
            INNER JOIN perusahaan_user pu ON p.id = pu.perusahaan_id
            WHERE pu.user_id = ?', [auth()->user()->id]);
    }
}
