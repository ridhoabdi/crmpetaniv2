<?php

namespace App\Http\Controllers;

use App\Models\Kegiatansawah;
use App\Models\Kspestisida;
use App\Models\Kspupuk;
use App\Models\Lokasisawah;
use App\Models\Panen;
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
        $lokasisawahs = Lokasisawah::where('user_id', $user_id)->first();
        $kegiatansawahs = Kegiatansawah::where('user_id', $user_id)->first();
        $kspupuks = Kspupuk::where('user_id', $user_id)->first();
        $kspestisidas = Kspestisida::where('user_id', $user_id)->first();
        $panens = Panen::where('user_id', $user_id)->first();
        if (!$lokasisawahs) {
            return view('pages.respon.responlokasisawah');
        } elseif (!$kegiatansawahs) {
            return view('pages.respon.responkegiatansawah');
        } elseif (!$kspupuks) {
            return view('pages.respon.responkegiatanpupuk');
        } elseif (!$kspestisidas) {
            return view('pages.respon.responkegiatanpestisida');
        } elseif (!$panens) {
            return view('pages.respon.responpanen');
        } else {
            $panens = DB::table('panens')
                ->join('lokasisawahs', 'panens.lokasisawah_id', '=', 'lokasisawahs.id')
                ->join('kabupatens', 'lokasisawahs.kabupaten_id', '=', 'kabupatens.id')
                ->join('kegiatansawahs', 'panens.kegiatansawah_id', '=', 'kegiatansawahs.id')
                ->select('panens.*', 'kabupatens.kabupaten_nama', 'lokasisawahs.lokasisawah_keterangan', 'kegiatansawahs.ks_waktu_tanam', 'kegiatansawahs.ks_jumlah_bibit', 'kegiatansawahs.ks_jumlah_modal')
                ->where('panens.user_id', $user_id)
                ->where('lokasisawahs.lokasisawah_status', 1)
                ->where('kegiatansawahs.ks_panen', 1)
                ->orderBy('panen_tanggal', 'DESC')
                ->get();

            // return dd($data);
            return view('/pages/riwayatpanen/viewriwayatpanen', compact('panens'));
            
        }

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
