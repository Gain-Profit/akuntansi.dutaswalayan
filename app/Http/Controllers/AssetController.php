<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Asset;
use App\Http\Requests;
use Gate;
use DB;

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

        $hasil = Asset::where('perusahaan_id', $comp)->get();

        return $hasil;
    }
}
