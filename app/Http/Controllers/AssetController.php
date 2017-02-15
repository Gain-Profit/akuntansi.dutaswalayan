<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Asset;
use App\Http\Requests;
use Carbon\Carbon;
use Cache;
use Gate;

class AssetController extends Controller
{
    public function __constructor()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('asset.index');
    }

    public function getAsset($comp, $random)
    {
        if (Gate::denies('show-unit', $comp)) {
            abort(404);
        }

        $minutes = Carbon::now()->addDays(10);

        $hasil = Cache::remember('getAsset_' . $comp, $minutes, function() use ($comp){
            return Asset::where('perusahaan_id', $comp)->get();    
        });         

        return $hasil;
    }
}
