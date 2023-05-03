<?php

namespace App\Http\Controllers;

use App\Models\Kegiatansawah;
use App\Models\Kspestisida;
use App\Models\Kspupuk;
use App\Models\Lokasisawah;
use App\Models\Panen;
use PDF;
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

    public function pdfriwayatpanen($id){

        $user_id = auth()->user()->id;

        $panens = DB::table('panens')
            ->join('users', 'panens.user_id', '=', 'users.id')
            ->join('pengepuls', 'panens.user_id', '=', 'pengepuls.id')
            ->join('lokasisawahs', 'panens.lokasisawah_id', '=', 'lokasisawahs.id')
            ->join('kabupatens', 'lokasisawahs.kabupaten_id', '=', 'kabupatens.id')
            ->join('kegiatansawahs', 'panens.kegiatansawah_id', '=', 'kegiatansawahs.id')
            ->select('panens.*', 
                'users.pemilik_nama', 
                'pengepuls.pengepul_nama',
                'pengepuls.pengepul_kontak',
                'pengepuls.pengepul_kabupaten',
                'pengepuls.pengepul_alamat',
                'pemilik_tanggal_lahir', 
                'pemilik_kontak', 
                'pemilik_pendidikan', 
                'kabupatens.kabupaten_nama', 
                'lokasisawahs.iot_id', 
                'lokasisawahs.lokasisawah_keterangan', 
                'kegiatansawahs.ks_metode_pengairan', 
                'kegiatansawahs.ks_sumber_modal',
                'kegiatansawahs.ks_luas_lahan', 
                'kegiatansawahs.ks_jumlah_bibit', 
                'kegiatansawahs.ks_waktu_tanam', 
                'kegiatansawahs.ks_status_lahan', 
                'kegiatansawahs.ks_jumlah_modal')
            ->where('panens.user_id', $user_id)
            ->where('lokasisawahs.lokasisawah_status', 1)
            ->where('kegiatansawahs.ks_panen', 1)
            ->where('panens.id', $id)
            ->orderBy('panen_tanggal', 'DESC')
            ->get();
        
        $kspupuks = DB::table('kspupuks')
            ->join('lokasisawahs', 'kspupuks.lokasisawah_id', '=', 'lokasisawahs.id')
            ->join('kegiatansawahs', 'kspupuks.kegiatansawah_id', '=', 'kegiatansawahs.id')
            ->join('jenispupuks', 'kspupuks.jenispupuk_id', '=', 'jenispupuks.id')
            ->join('merkpupuks', 'kspupuks.merkpupuk_id', '=', 'merkpupuks.id')
            ->join('kabupatens', 'lokasisawahs.kabupaten_id', '=', 'kabupatens.id')
            ->select('kspupuks.*', 'kabupatens.kabupaten_nama', 'lokasisawahs.lokasisawah_keterangan', 'jenispupuks.jenispupuk_nama', 'merkpupuks.merkpupuk_nama', 'kegiatansawahs.ks_waktu_tanam')
            ->where('kspupuks.user_id', $user_id)
            ->where('kegiatansawahs.ks_panen', 1)
            ->where('lokasisawahs.lokasisawah_status', 1)
            ->where('kspupuks.id', $id)
            ->orderBy('ks_pupuk_tgl_rabuk', 'DESC')
            ->get();

        $kspestisidas = DB::table('kspestisidas')
            ->join('lokasisawahs', 'kspestisidas.lokasisawah_id', '=', 'lokasisawahs.id')
            ->join('kegiatansawahs', 'kspestisidas.kegiatansawah_id', '=', 'kegiatansawahs.id')
            ->join('pestisidas', 'kspestisidas.pestisida_id', '=', 'pestisidas.id')
            ->join('kabupatens', 'lokasisawahs.kabupaten_id', '=', 'kabupatens.id')
            ->select('kspestisidas.*', 'kabupatens.kabupaten_nama', 'lokasisawahs.lokasisawah_keterangan', 'pestisidas.pestisida_nama', 'kegiatansawahs.ks_waktu_tanam')
            ->where('kspestisidas.user_id', $user_id)
            ->where('kegiatansawahs.ks_panen', 1)
            ->where('lokasisawahs.lokasisawah_status', 1)
            ->where('kspestisidas.id', $id)
            ->orderBy('ks_pestisida_tgl_semprot', 'DESC')
            ->get();

        $pdf = PDF::loadView('pages.riwayatpanen.pdfriwayatpanen', compact('panens', 'kspupuks', 'kspestisidas'));
        $pdf->setPaper('A4', 'portrait');
        return $pdf->stream('riwayat-panen.pdf'); // Memberikan nama file pada metode stream()

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
