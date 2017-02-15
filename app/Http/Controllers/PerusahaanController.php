<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Carbon\Carbon;
use Cache;
use DB;

class PerusahaanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getPerusahaans($random)
    {
        
        $user_id = auth()->user()->id;
        
        $minutes = Carbon::now()->addDays(7);

        $hasil = Cache::remember('perusahaans_' . $user_id, $minutes, function() use ($user_id){
            return DB::select('SELECT p.id, p.nama 
                FROM perusahaans p 
                INNER JOIN perusahaan_user pu ON p.id = pu.perusahaan_id
                WHERE pu.user_id = ?', [$user_id]);  
        });         
        return $hasil;
    }
}
