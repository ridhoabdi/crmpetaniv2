<?php

namespace App\Http\Controllers;

use App\Models\Kegiatansawah;
use App\Models\Kspupuk;
use App\Models\Lokasisawah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KspupukController extends Controller
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
            $kspupuks = DB::table('kspupuks')
                ->join('lokasisawahs', 'kspupuks.lokasisawah_id', '=', 'lokasisawahs.id')
                ->join('kegiatansawahs', 'kspupuks.kegiatansawah_id', '=', 'kegiatansawahs.id')
                ->join('jenispupuks', 'kspupuks.jenispupuk_id', '=', 'jenispupuks.id')
                ->join('merkpupuks', 'kspupuks.merkpupuk_id', '=', 'merkpupuks.id')
                ->join('kabupatens', 'lokasisawahs.kabupaten_id', '=', 'kabupatens.id')
                ->select('kspupuks.*', 'kabupatens.kabupaten_nama', 'lokasisawahs.lokasisawah_keterangan', 'jenispupuks.jenispupuk_nama', 'merkpupuks.merkpupuk_nama', 'kegiatansawahs.ks_waktu_tanam')
                ->where('kspupuks.user_id', $user_id)
                ->where('lokasisawahs.lokasisawah_status', 0)
                ->where('kegiatansawahs.ks_panen', 0)
                ->orderBy('ks_pupuk_tgl_rabuk', 'DESC')
                ->get();

            // return dd($kspupuks);
            return view('pages.kegiatanpupuk.viewkegiatanpupuk', compact('kspupuks'));

        }
    }

    public function fetchMerkpupuks($jenispupuk_id = null)
    {
        $merkpupuks = DB::table('merkpupuks')->where('jenispupuk_id', $jenispupuk_id)->get();
        return response()->json([
            'status' => 1,
            'merkpupuks' => $merkpupuks
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user_id = auth()->user()->id;

        $lokasisawahs =  DB::table('lokasisawahs')
            ->join('kabupatens', 'kabupatens.id', '=', 'lokasisawahs.kabupaten_id')
            ->select('lokasisawahs.*', 'kabupatens.kabupaten_nama')
            ->orderBy('kabupaten_nama', 'ASC')
            ->orderBy('lokasisawah_keterangan', 'ASC')
            ->where('lokasisawahs.user_id', $user_id)
            ->where('lokasisawahs.lokasisawah_status', 0)
            ->get();

        $jenispupuks = DB::table('jenispupuks')
            ->orderBy('jenispupuk_nama', 'ASC')
            ->get();

        $kegiatansawahs = DB::table('kegiatansawahs')
            ->where('ks_panen', 0)
            ->where('kegiatansawahs.user_id', $user_id)
            ->orderBy('ks_waktu_tanam', 'ASC')
            ->get();
    
        $data['lokasisawahs'] = $lokasisawahs;
        $data['jenispupuks'] = $jenispupuks;
        $data['kegiatansawahs'] = $kegiatansawahs;

        // return dd($data);
        return view('/pages/kegiatanpupuk/addkegiatanpupuk', $data);
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

        // jumlah takaran pupuk
        $jmlPupuk = $request->input('ks_pupuk_jumlah_takaran');
        $stnJmlPupuk = $request->input('stnPupuk');
        $dataHasiljumlahPupuk = $jmlPupuk;
        if ($stnJmlPupuk == "Kuintal") {
            $dataHasiljumlahPupuk = $dataHasiljumlahPupuk * 100;
        }
        if ($stnJmlPupuk == "Ton") {
            $dataHasiljumlahPupuk = $dataHasiljumlahPupuk * 1000;
        } else {
            $dataHasiljumlahPupuk = $dataHasiljumlahPupuk;
        }

        // menginputkan data maksimal 5 kali

        // Cek jumlah data kegiatan pupuk yang dimiliki oleh user
        $kspupuk_count = Kspupuk::where('user_id', $user_id)->count();

        // Jika jumlah data kurang dari atau sama dengan 5, simpan data
        if ($kspupuk_count < 5) {
            $request->validate([
                'lokasisawah_id' => 'required|exists:lokasisawahs,id',
                'kegiatansawah_id' => 'required|exists:kegiatansawahs,id',
                'ks_pupuk_tgl_rabuk' => 'required',
                'jenispupuk_id' => 'required|exists:jenispupuks,id',
                'merkpupuk_id' => 'required|exists:merkpupuks,id',
                'ks_pupuk_jumlah_takaran' => 'required'
            ], [
                'lokasisawah_id' => '*Field ini wajib diisi',
                'kegiatansawah_id' => '*Field ini wajib diisi',
                'ks_pupuk_tgl_rabuk' => '*Field ini wajib diisi',
                'jenispupuk_id' => '*Field ini wajib diisi',
                'merkpupuk_id' => '*Field ini wajib diisi',
                'ks_pupuk_jumlah_takaran' => '*Field ini wajib diisi',
            ]);
    
            Kspupuk::create([
                'user_id' => $user_id,
                'lokasisawah_id' => $request->lokasisawah_id,
                'kegiatansawah_id' => $request->kegiatansawah_id,
                'ks_pupuk_tgl_rabuk' => $request->ks_pupuk_tgl_rabuk,
                'jenispupuk_id' => $request->jenispupuk_id,
                'merkpupuk_id' => $request->merkpupuk_id,
                'ks_pupuk_jumlah_takaran' => $dataHasiljumlahPupuk,
                'ks_pupuk_keterangan' => $request->ks_pupuk_keterangan
            ]);
    
            return redirect('/viewkegiatanpupuk')->with('success', 'Data berhasil disimpan');

        } else {
            // Jika jumlah data lebih dari 5, tampilkan pesan error
            return redirect('/viewkegiatanpupuk')->with('error', 'Maaf, Anda hanya dapat menambahkan 5 kegiatan pupuk');
        }
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
        $user_id = auth()->user()->id;

        $kspupuks = Kspupuk::where('user_id', $user_id)
            ->find($id);

        if (!$kspupuks) {
            return redirect('/viewkegiatanpupuk')->with('error', 'Data tidak ditemukan');
        }

        $lokasisawahs =  DB::table('lokasisawahs')
            ->join('kabupatens', 'kabupatens.id', '=', 'lokasisawahs.kabupaten_id')
            ->select('lokasisawahs.*', 'kabupatens.kabupaten_nama')
            ->orderBy('kabupaten_nama', 'ASC')
            ->orderBy('lokasisawah_keterangan', 'ASC')
            ->where('lokasisawahs.user_id', $user_id)
            ->get();

        $jenispupuks = DB::table('jenispupuks')
            ->orderBy('jenispupuk_nama', 'ASC')
            ->get();

        $merkpupuks = DB::table('merkpupuks')->where('jenispupuk_id', $kspupuks->jenispupuk_id)
            ->orderBy('merkpupuk_nama', 'ASC')
            ->get();

        $kegiatansawahs = DB::table('kegiatansawahs')
            ->where('ks_panen', 0)
            ->where('kegiatansawahs.user_id', $user_id)
            ->orderBy('ks_waktu_tanam', 'ASC')
            ->get();
        
        $data['kspupuks'] = $kspupuks;
        $data['lokasisawahs'] = $lokasisawahs;
        $data['kegiatansawahs'] = $kegiatansawahs;
        $data['jenispupuks'] = $jenispupuks;
        $data['merkpupuks'] = $merkpupuks;

        // return dd($data);
        return view('/pages/kegiatanpupuk/editkegiatanpupuk', $data);
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
        $kspupuks = Kspupuk::where('id', $id)->where('user_id', auth()->user()->id)->first();

        if (!$kspupuks) {
            return redirect('/viewkegiatanpupuk')->with('error', 'Data tidak ditemukan');
        }

        // jumlah takaran pupuk
        $jmlPupuk = $request->input('ks_pupuk_jumlah_takaran');
        $stnJmlPupuk = $request->input('stnPupuk');
        $dataHasiljumlahPupuk = $jmlPupuk;
        if ($stnJmlPupuk == "Kuintal") {
            $dataHasiljumlahPupuk = $dataHasiljumlahPupuk * 100;
        }
        if ($stnJmlPupuk == "Ton") {
            $dataHasiljumlahPupuk = $dataHasiljumlahPupuk * 1000;
        } else {
            $dataHasiljumlahPupuk = $dataHasiljumlahPupuk;
        }

        $request->validate([
            'lokasisawah_id' => 'required|exists:lokasisawahs,id',
            'kegiatansawah_id' => 'required|exists:kegiatansawahs,id',
            'ks_pupuk_tgl_rabuk' => 'required',
            'jenispupuk_id' => 'required|exists:jenispupuks,id',
            'merkpupuk_id' => 'required|exists:merkpupuks,id',
            'ks_pupuk_jumlah_takaran' => 'required'
        ], [
            'lokasisawah_id' => '*Field ini wajib diisi',
            'kegiatansawah_id' => '*Field ini wajib diisi',
            'ks_pupuk_tgl_rabuk' => '*Field ini wajib diisi',
            'jenispupuk_id' => '*Field ini wajib diisi',
            'merkpupuk_id' => '*Field ini wajib diisi',
            'ks_pupuk_jumlah_takaran' => '*Field ini wajib diisi',
        ]);

        $kspupuks->update([
            'lokasisawah_id' => $request->lokasisawah_id,
            'kegiatansawah_id' => $request->kegiatansawah_id,
            'ks_pupuk_tgl_rabuk' => $request->ks_pupuk_tgl_rabuk,
            'jenispupuk_id' => $request->jenispupuk_id,
            'merkpupuk_id' => $request->merkpupuk_id,
            'ks_pupuk_jumlah_takaran' => $dataHasiljumlahPupuk,
            'ks_pupuk_keterangan' => $request->ks_pupuk_keterangan
        ]);

        return redirect('/viewkegiatanpupuk')->with('success', 'Data berhasil diedit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $kspupuks = Kspupuk::find($id);

        if (!$kspupuks) {
            return redirect('/viewkegiatanpupuk')->with('error', 'Data tidak ditemukan');
        }

        $kspupuks->delete();
        return redirect('/viewkegiatanpupuk')->with('success', 'Data berhasil dihapus');
    }
}
