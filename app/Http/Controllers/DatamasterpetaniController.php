<?php

namespace App\Http\Controllers;

use App\Models\Datamasterpetani;
use App\Models\Kegiatansawah;
use App\Models\Kspestisida;
use App\Models\Kspupuk;
use App\Models\Lokasisawah;
use App\Models\Panen;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DatamasterpetaniController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $user_id = auth()->user()->id;

        $data = Panen::find($id);

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

        return view('/pages/datamasterpetani/confirmbackup', compact('data', 'kspupuks', 'kspestisidas', 'id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // user id
        $user_id = auth()->user()->id;

        // lokasisawah_id
        $lokasisawah_id = $request->input('lokasisawah_id');

        // kegiatansawah_id
        $kegiatansawah_id = $request->input('kegiatansawah_id');

        // kspupuk_id
        $kspupuk_id = $request->input('kspupuk_id');

        // kspestisida_id
        $kspestisida_id = $request->input('kspestisida_id');

        // panen_id
        $panen_id = $request->input('id');

        Datamasterpetani::create([
            'user_id' => $user_id,
            'lokasisawah_id' => $lokasisawah_id,
            'kegiatansawah_id' => $kegiatansawah_id,
            'kspupuk_id' => $kspupuk_id,
            'kspestisida_id' => $kspestisida_id,
            'panen_id' => $panen_id
        ]);

        // Code Send Data API Couch DB
        $datamasterpetanis = DB::table('datamasterpetanis')
            // join
            ->join('users', 'datamasterpetanis.user_id', '=', 'users.id')
            ->join('lokasisawahs', 'datamasterpetanis.lokasisawah_id', '=', 'lokasisawahs.id')
            ->join('kegiatansawahs', 'datamasterpetanis.kegiatansawah_id', '=', 'kegiatansawahs.id')
            ->join('kspestisidas', 'datamasterpetanis.kspestisida_id', '=', 'kspestisidas.id')
            ->join('kspupuks', 'datamasterpetanis.kspupuk_id', '=', 'kspupuks.id')
            ->join('panens', 'datamasterpetanis.panen_id', '=', 'panens.id')
            ->join('kabupatens', 'lokasisawahs.kabupaten_id', '=', 'kabupatens.id')
            ->join('varietasbawangs', 'kegiatansawahs.varietasbawang_id', '=', 'varietasbawangs.id')
            ->join('pestisidas', 'kspestisidas.pestisida_id', '=', 'pestisidas.id')
            ->join('jenispupuks', 'kspupuks.jenispupuk_id', '=', 'jenispupuks.id')
            ->join('merkpupuks', 'kspupuks.merkpupuk_id', '=', 'merkpupuks.id')
            ->join('pengepuls', 'panens.pengepul_id', '=', 'pengepuls.id')
            // select
            ->select('datamasterpetanis.*',
                'users.pemilik_nama',
                'users.pemilik_jeniskelamin',
                'users.pemilik_tanggal_lahir',
                'users.pemilik_kontak',
                'users.pemilik_pendidikan',
                'pengepuls.pengepul_nama',
                'pengepuls.pengepul_kontak',
                'pengepuls.pengepul_kabupaten',
                'pengepuls.pengepul_alamat',
                'kabupatens.kabupaten_nama',
                'lokasisawahs.lokasisawah_keterangan',
                'kegiatansawahs.ks_metode_pengairan',
                'kegiatansawahs.ks_sumber_modal',
                'kegiatansawahs.ks_luas_lahan',
                'varietasbawangs.varietasbawang_nama',
                'kegiatansawahs.ks_jumlah_bibit',
                'kegiatansawahs.ks_waktu_tanam',
                'kegiatansawahs.ks_status_lahan',
                'kegiatansawahs.ks_jumlah_modal',
                'kspestisidas.ks_pestisida_tgl_semprot',
                'kspestisidas.ks_pestisida_jumlah_takaran',
                'kspestisidas.ks_pestisida_keterangan',
                'pestisidas.pestisida_nama',
                'kspupuks.ks_pupuk_tgl_rabuk',
                'kspupuks.ks_pupuk_jumlah_takaran',
                'jenispupuks.jenispupuk_nama',
                'merkpupuks.merkpupuk_nama',
                'kspupuks.ks_pupuk_keterangan',
                'panens.panen_tanggal',
                'panens.panen_jumlah',
                'panens.panen_kualitas_a',
                'panens.panen_kualitas_b',
                'panens.panen_kualitas_c',
                'panens.panen_harga')
            // where
            ->where('datamasterpetanis.user_id', $user_id)
            ->where('kegiatansawahs.ks_panen', 1)
            ->where('lokasisawahs.lokasisawah_status', 1)
            // get
            ->get();

        foreach ($datamasterpetanis as $item) {
            $client = new Client();
            $api_url = "http://54.169.39.32:3000/API/postPetani";
            // return dd($item->user_id);
            $res = $client->post($api_url, [
                'json' => [
                    // identitas petani
                    "id_petani"=> $item->user_id,
                    "nama_petani"=> $item->pemilik_nama,
                    "jeniskelamin_petani" => $item->pemilik_jeniskelamin,
                    "tanggallahir_petani"=> $item->pemilik_tanggal_lahir,
                    "kontak_petani"=> $item->pemilik_kontak,
                    "pendidikan_petani"=> $item->pemilik_pendidikan,
                    // identitas pengepul
                    "nama_pengepul"=> $item->pengepul_nama,
                    "kontak_pengepul"=> $item->pengepul_kontak,
                    "kab_pengepul"=> $item->pengepul_kabupaten,
                    "alamat_pengepul"=> $item->pengepul_alamat,
                    // aktivitas petani
                    "kab_petani"=> $item->kabupaten_nama, 
                    "lokasi_sawah"=> $item->lokasisawah_keterangan,
                    "waktu_tanam"=> $item->ks_waktu_tanam,
                    "metode_pengairan"=> $item->ks_metode_pengairan,
                    "sumber_modal"=> $item->ks_sumber_modal,
                    "jumlah_modal"=> $item->ks_jumlah_modal,
                    "status_lahan"=> $item->ks_status_lahan,
                    "luas_lahan"=> $item->ks_luas_lahan,
                    "varietas_bawang" => $item->varietasbawang_nama,
                    "jumlah_bibit"=> $item->ks_jumlah_bibit,
                    "tanggal_semprot"=> $item->ks_pestisida_tgl_semprot,
                    "jumlah_takaran_pestisida"=> $item->ks_pestisida_jumlah_takaran,
                    "keterangan_pestisida"=> $item->ks_pestisida_keterangan,
                    "nama_pestisida"=> $item->pestisida_nama,
                    "tanggal_pupuk_abuk"=> $item->ks_pupuk_tgl_rabuk,
                    "jumlah_takaran_pupuk"=> $item->ks_pupuk_jumlah_takaran,
                    "jenis_pupuk"=> $item->jenispupuk_nama,
                    "merek_pupuk"=> $item->merkpupuk_nama,
                    "keterangan_pupuk"=> $item->ks_pupuk_keterangan,
                    "tanggal_panen"=> $item->panen_tanggal,
                    "jumlah_panen"=> $item->panen_jumlah,
                    "kualitas_bagus"=> $item->panen_kualitas_a,
                    "kualitas_sedang"=> $item->panen_kualitas_b,
                    "kualitas_buruk"=> $item->panen_kualitas_c, 
                    "harga_panen"=> $item->panen_harga,
                    "created_at"=> $item->created_at,
                    "updated_at"=> $item->updated_at
                ]
            ]);
        }

        // return dd($datamasterpetanis);
        // End Code Logic Send Data API Couch DB
        return redirect('/viewpanen')->with('success', 'Data berhasil dibackup');
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
