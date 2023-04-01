<?php

namespace App\Http\Controllers;

use App\Models\Kegiatansawah;
use App\Models\Lokasisawah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KspestisidaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = auth()->user()->id;
        $lokasisawahs = Lokasisawah::where('user_id', $user_id)->first();
        $kegiatansawahs = Kegiatansawah::where('user_id', $user_id)->first();
        if (!$lokasisawahs) {
            return view('pages.respon.responlokasisawah');
        } elseif (!$kegiatansawahs) {
            return view('pages.respon.responkegiatansawah');
        } else {
            $kspestisidas = DB::table('kspestisidas')
                ->join('lokasisawahs', 'kspestisidas.lokasisawah_id', '=', 'lokasisawahs.id')
                ->join('kegiatansawahs', 'kspestisidas.kegiatansawah_id', '=', 'kegiatansawahs.id')
                ->join('pestisidas', 'kspestisidas.pestisida_id', '=', 'pestisidas.id')
                ->join('kabupatens', 'lokasisawahs.kabupaten_id', '=', 'kabupatens.id')
                ->select('kspestisidas.*', 'kabupatens.kabupaten_nama', 'lokasisawahs.lokasisawah_keterangan', 'pestisidas.pestisida_nama')
                ->where('kspestisidas.user_id', $user_id)
                ->get();

            return dd($kspestisidas);
            // return view('pages.kegiatanpestisida.viewkegiatanpestisida', compact('kspestisidas'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
