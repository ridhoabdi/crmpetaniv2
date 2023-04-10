<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RiwayatpanenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = auth()->user()->id;
        $kegiatansawahs = DB::table('kegiatansawahs')
            ->join('lokasisawahs', 'kegiatansawahs.lokasisawah_id', '=', 'lokasisawahs.id')
            ->join('kabupatens', 'lokasisawahs.kabupaten_id', '=', 'kabupatens.id')
            ->select('kegiatansawahs.*', 'kabupatens.kabupaten_nama', 'lokasisawahs.lokasisawah_keterangan')
            ->where('kegiatansawahs.user_id', $user_id)
            ->where('kegiatansawahs.ks_panen', 0)
            ->get();

        $kspestisidas = DB::table('kspestisidas')
            ->join('lokasisawahs', 'kspestisidas.lokasisawah_id', '=', 'lokasisawahs.id')
            ->join('kegiatansawahs', 'kspestisidas.kegiatansawah_id', '=', 'kegiatansawahs.id')
            ->join('pestisidas', 'kspestisidas.pestisida_id', '=', 'pestisidas.id')
            ->join('kabupatens', 'lokasisawahs.kabupaten_id', '=', 'kabupatens.id')
            ->select('kspestisidas.*', 'kabupatens.kabupaten_nama', 'lokasisawahs.lokasisawah_keterangan', 'pestisidas.pestisida_nama', 'kegiatansawahs.ks_waktu_tanam')
            ->where('kspestisidas.user_id', $user_id)
            ->where('kegiatansawahs.ks_panen', 0)
            ->orderBy('ks_pestisida_tgl_semprot', 'DESC')
            ->get();

        $kspupuks = DB::table('kspupuks')
            ->join('lokasisawahs', 'kspupuks.lokasisawah_id', '=', 'lokasisawahs.id')
            ->join('kegiatansawahs', 'kspupuks.kegiatansawah_id', '=', 'kegiatansawahs.id')
            ->join('jenispupuks', 'kspupuks.jenispupuk_id', '=', 'jenispupuks.id')
            ->join('merkpupuks', 'kspupuks.merkpupuk_id', '=', 'merkpupuks.id')
            ->join('kabupatens', 'lokasisawahs.kabupaten_id', '=', 'kabupatens.id')
            ->select('kspupuks.*', 'kabupatens.kabupaten_nama', 'lokasisawahs.lokasisawah_keterangan', 'jenispupuks.jenispupuk_nama', 'merkpupuks.merkpupuk_nama', 'kegiatansawahs.ks_waktu_tanam')
            ->where('kspupuks.user_id', $user_id)
            ->where('kegiatansawahs.ks_panen', 0)
            ->orderBy('ks_pupuk_tgl_rabuk', 'DESC')
            ->get();

        $data['kegiatansawahs'] = $kegiatansawahs;
        $data['kspestisidas'] = $kspestisidas;
        $data['kspupuks'] = $kspupuks;
        return dd($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
