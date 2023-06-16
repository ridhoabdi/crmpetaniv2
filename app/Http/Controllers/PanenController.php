<?php

namespace App\Http\Controllers;

use App\Models\Kegiatansawah;
use App\Models\Kspestisida;
use App\Models\Kspupuk;
use App\Models\Lokasisawah;
use App\Models\Panen;
use App\Models\Pengepul;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PanenController extends Controller
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

        if (!$lokasisawahs) {
            return view('pages.respon.responlokasisawah');
        } elseif (!$kegiatansawahs) {
            return view('pages.respon.responkegiatansawah');
        } elseif (!$kspupuks) {
            return view('pages.respon.responkegiatanpupuk');
        } elseif (!$kspestisidas) {
            return view('pages.respon.responkegiatanpestisida');
        }else {
            $panens = DB::table('kegiatansawahs')
                ->join('lokasisawahs', 'kegiatansawahs.lokasisawah_id', '=', 'lokasisawahs.id')
                ->join('kabupatens', 'lokasisawahs.kabupaten_id', '=', 'kabupatens.id')
                ->join('varietasbawangs', 'kegiatansawahs.varietasbawang_id', '=', 'varietasbawangs.id')
                ->select('kegiatansawahs.*', 'kabupatens.kabupaten_nama', 'lokasisawahs.lokasisawah_keterangan', 'varietasbawangs.varietasbawang_nama', 'kegiatansawahs.ks_panen')
                ->where('kegiatansawahs.user_id', $user_id)
                ->orderBy('ks_waktu_tanam', 'DESC')
                ->get();

            // return dd($panens);
            return view('/pages/panen/viewpanen', compact('panens'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $users = Kegiatansawah::find($id);
        $panens = DB::table('panens')
            ->where('panens.kegiatansawah_id', $id)
            ->get();
        if ($panens == '[]') {
            $reviewpanen = ("datakosong");
            return view('/pages/panen/addpanen', compact('users', 'reviewpanen', 'id'));
        } else {
            foreach ($panens as $datapanen) {
                if ((int)($datapanen->kegiatansawah_id) == (int)$id) {
                    $reviewpanen =  $panens;
                } else {
                    $reviewpanen = ("datakosong");
                }
                return view('/pages/panen/addpanen', compact('users', 'reviewpanen', 'id'));
            }
        }
    }

    // cari nama pengepul
    public function loadData(Request $request)
    {
        if ($request->has('q')) {
            $cari = $request->q;
            $data = DB::table('pengepuls')->whereRaw('LOWER(pengepul_nama) LIKE ?', '%' . strtolower($cari) . '%')->get();
            return response()->json($data);
        }
        
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
        $kegiatansawah_id = $request->input('id');
        
        // konversi data panen ke kg
        $panenJumlah = $request->input('panen_jumlah');
        $stnPanen = $request->input('stnPanen');
        $hasilSatuanJumlah = $stnPanen;
        if ($stnPanen == "Kilogram") {
            $hasilSatuanJumlah = $panenJumlah;
        } elseif ($stnPanen == "Kuintal") {
            $hasilSatuanJumlah = $panenJumlah * 100;
        } elseif ($stnPanen == "Ton") {
            $hasilSatuanJumlah = $panenJumlah * 1000;
        }

        // pengepul_id
        $pengepul_id = $request->input('cari');

        // harga panen
        $panen_harga = $request->input('panen_harga');
        $panen_harga = preg_replace("/[^0-9]/", "", $panen_harga); // menghapus karakter selain angka
        $panen_harga = intval($panen_harga); // mengonversi nilai menjadi integer

        $request->validate([
            'panen_tanggal' => 'required',
            'panen_jumlah' => 'required',
            'panen_harga' => 'required'
        ], [
            'panen_tanggal' => '*Field ini wajib diisi',
            'panen_jumlah' => '*Field ini wajib diisi',
            'panen_harga' => '*Field ini wajib diisi'
        ]);

        Panen::create([
            'user_id' => $user_id,
            'pengepul_id' => $pengepul_id,
            'lokasisawah_id' => $lokasisawah_id,
            'kegiatansawah_id' => $kegiatansawah_id,
            'panen_tanggal' => $request->panen_tanggal,
            'panen_jumlah' => (int)$hasilSatuanJumlah,
            'panen_harga' => $panen_harga,
            'panen_status' => $request->panen_status,
            'statusdaripengepul' => $request->statusdaripengepul
        ]);

        $updatekspanen = DB::table('kegiatansawahs')->where('user_id', $user_id)->update(['ks_panen' => '1']);

        $updatestatuslokasi = DB::table('lokasisawahs')->where('user_id', $user_id)->update(['lokasisawah_status' => '1']);

        return redirect('/viewpanen')->with('success', 'Data berhasil disimpan');
    }

    public function verifypetani(Request $request)
    {
        $id_Petani = $request->input('idSawahpetani');
        $verifyPanen = $request->input('verify-checkbox');
        $updatekspanen = DB::table('kegiatansawahs')->where('id', $id_Petani)->update(['ks_panen' => $verifyPanen]);
        return redirect()->route('/viewpanen')->with('success', 'Data Panen telah berhasil diverifikasi');
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
        // $data = Panen::find($id);
        // return dd($data);
        // return view('/pages/panen/editpanen', compact('data'));

        // $user_id = auth()->user()->id;
        // $panens = Panen::where('user_id', $user_id)
        //     ->find($id);
        // if (!$panens) {
        //     return redirect('/viewpanen')->with('error', 'Data tidak ditemukan');
        // }
        // $data['panens'] = $panens;
        // return dd($data);
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
        // // konversi data panen ke kg
        // $panenJumlah = $request->input('panen_jumlah');
        // $stnPanen = $request->input('stnPanen');
        // $hasilSatuanJumlah = $stnPanen;
        // if ($stnPanen == "Kilogram") {
        //     $hasilSatuanJumlah = $panenJumlah;
        // } elseif ($stnPanen == "Kuintal") {
        //     $hasilSatuanJumlah = $panenJumlah * 100;
        // } elseif ($stnPanen == "Ton") {
        //     $hasilSatuanJumlah = $panenJumlah * 1000;
        // }

        // // harga panen
        // $panen_harga = $request->input('panen_harga');
        // $panen_harga = preg_replace("/[^0-9]/", "", $panen_harga); // menghapus karakter selain angka
        // $panen_harga = intval($panen_harga); // mengonversi nilai menjadi integer

        // $request->validate([
        //     'panen_tanggal' => 'required',
        //     'panen_jumlah' => 'required',
        //     'panen_harga' => 'required'
        // ], [
        //     'panen_tanggal' => '*Field ini wajib diisi',
        //     'panen_jumlah' => '*Field ini wajib diisi',
        //     'panen_harga' => '*Field ini wajib diisi'
        // ]);

        // $data = panen::find($id);
        // $data->update([
        //     'panen_tanggal' => $request->panen_tanggal,
        //     'panen_jumlah' => (int)$hasilSatuanJumlah,
        //     'panen_harga' => $panen_harga
        // ]);

        // return redirect('/viewpanen')->with('success', 'Data berhasil diupdate');
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
