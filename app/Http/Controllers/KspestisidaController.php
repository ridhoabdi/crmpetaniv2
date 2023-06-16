<?php

namespace App\Http\Controllers;

use App\Models\Kegiatansawah;
use App\Models\Kspestisida;
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
                ->select('kspestisidas.*', 'kabupatens.kabupaten_nama', 'lokasisawahs.lokasisawah_keterangan', 'pestisidas.pestisida_nama', 'kegiatansawahs.ks_waktu_tanam')
                ->where('kspestisidas.user_id', $user_id)
                ->where('lokasisawahs.lokasisawah_status', 0)
                ->where('kegiatansawahs.ks_panen', 0)
                ->orderBy('ks_pestisida_tgl_semprot', 'DESC')
                ->get();

            // return dd($kspestisidas);
            return view('pages.kegiatanpestisida.viewkegiatanpestisida', compact('kspestisidas'));
        }
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

        $pestisidas = DB::table('pestisidas')
            ->orderBy('pestisida_nama', 'ASC')
            ->get();

        $kegiatansawahs = DB::table('kegiatansawahs')
            ->where('ks_panen', 0)
            ->where('kegiatansawahs.user_id', $user_id)
            ->orderBy('ks_waktu_tanam', 'ASC')
            ->get();
    
        $data['lokasisawahs'] = $lokasisawahs;
        $data['pestisidas'] = $pestisidas;
        $data['kegiatansawahs'] = $kegiatansawahs;

        // return dd($data);
        return view('/pages/kegiatanpestisida/addkegiatanpestisida', $data);
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

        // jumlah takaran pestisida
        $dataJumlahTakaranPestisida = $request->input('ks_pestisida_jumlah_takaran');
        $stnJumlahTakaranPestisida = $request->input('stnJumlahTakaranPestisida');
        $dataHasilJumlahTakaranPestisida = $dataJumlahTakaranPestisida;
        if ($stnJumlahTakaranPestisida == "Mililiter") {
            $dataHasilJumlahTakaranPestisida = $dataHasilJumlahTakaranPestisida * 0.001;
        } else {
            $dataHasilJumlahTakaranPestisida = $dataHasilJumlahTakaranPestisida;
        }

        // menginputkan data maksimal 5 kali

        // Cek jumlah data kegiatan pestisida yang dimiliki oleh user
        $kspestisida_count = Kspestisida::where('user_id', $user_id)->count();

        // Jika jumlah data kurang dari atau sama dengan 5, simpan data
        if ($kspestisida_count < 5) {
            $request->validate([
                'lokasisawah_id' => 'required|exists:lokasisawahs,id',
                'kegiatansawah_id' => 'required|exists:kegiatansawahs,id',
                'ks_pestisida_tgl_semprot' => 'required',
                'pestisida_id' => 'required|exists:pestisidas,id',
                'ks_pestisida_jumlah_takaran' => 'required'
            ], [
                'lokasisawah_id' => '*Field ini wajib diisi',
                'kegiatansawah_id' => '*Field ini wajib diisi',
                'ks_pestisida_tgl_semprot' => '*Field ini wajib diisi',
                'pestisida_id' => '*Field ini wajib diisi',
                'ks_pestisida_jumlah_takaran' => '*Field ini wajib diisi',
            ]);
    
            Kspestisida::create([
                'user_id' => $user_id,
                'kegiatansawah_id' => $request->kegiatansawah_id,
                'lokasisawah_id' => $request->lokasisawah_id,
                'ks_pestisida_tgl_semprot' => $request->ks_pestisida_tgl_semprot,
                'pestisida_id' => $request->pestisida_id,
                'ks_pestisida_jumlah_takaran' => $dataHasilJumlahTakaranPestisida,
                'ks_pestisida_keterangan' => $request->ks_pestisida_keterangan
            ]);
    
            return redirect('/viewkegiatanpestisida')->with('success', 'Data berhasil disimpan');

        } else {
            // Jika jumlah data lebih dari 5, tampilkan pesan error
            return redirect('/viewkegiatanpestisida')->with('error', 'Maaf, Anda hanya dapat menambahkan 5 kegiatan pestisida');
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

        $kspestisidas = Kspestisida::where('user_id', $user_id)
            ->find($id);

        if (!$kspestisidas) {
            return redirect('/viewkegiatanpestisida')->with('error', 'Data tidak ditemukan');
        }

        $lokasisawahs =  DB::table('lokasisawahs')
            ->join('kabupatens', 'kabupatens.id', '=', 'lokasisawahs.kabupaten_id')
            ->select('lokasisawahs.*', 'kabupatens.kabupaten_nama')
            ->orderBy('kabupaten_nama', 'ASC')
            ->orderBy('lokasisawah_keterangan', 'ASC')
            ->where('lokasisawahs.user_id', $user_id)
            ->get();

        $pestisidas = DB::table('pestisidas')
            ->orderBy('pestisida_nama', 'ASC')
            ->get();

        $kegiatansawahs = DB::table('kegiatansawahs')
            ->where('ks_panen', 0)
            ->where('kegiatansawahs.user_id', $user_id)
            ->orderBy('ks_waktu_tanam', 'ASC')
            ->get();
    
        $data['lokasisawahs'] = $lokasisawahs;
        $data['pestisidas'] = $pestisidas;
        $data['kegiatansawahs'] = $kegiatansawahs;
        $data['kspestisidas'] = $kspestisidas;

        // return dd($data);
        return view('pages/kegiatanpestisida/editkegiatanpestisida', $data);
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
        $kspestisidas = Kspestisida::where('id', $id)->where('user_id', auth()->user()->id)->first();

        if (!$kspestisidas) {
            return redirect('/viewkegiatanpestisida')->with('error', 'Data tidak ditemukan');
        }
        
        // jumlah takaran pestisida
        $dataJumlahTakaranPestisida = $request->input('ks_pestisida_jumlah_takaran');
        $stnJumlahTakaranPestisida = $request->input('stnJumlahTakaranPestisida');
        $dataHasilJumlahTakaranPestisida = $dataJumlahTakaranPestisida;
        if ($stnJumlahTakaranPestisida == "Mililiter") {
            $dataHasilJumlahTakaranPestisida = $dataHasilJumlahTakaranPestisida * 0.001;
        } else {
            $dataHasilJumlahTakaranPestisida = $dataHasilJumlahTakaranPestisida;
        }

        $request->validate([
            'lokasisawah_id' => 'required|exists:lokasisawahs,id',
            'kegiatansawah_id' => 'required|exists:kegiatansawahs,id',
            'ks_pestisida_tgl_semprot' => 'required',
            'pestisida_id' => 'required|exists:pestisidas,id',
            'ks_pestisida_jumlah_takaran' => 'required'
        ], [
            'lokasisawah_id' => '*Field ini wajib diisi',
            'kegiatansawah_id' => '*Field ini wajib diisi',
            'ks_pestisida_tgl_semprot' => '*Field ini wajib diisi',
            'pestisida_id' => '*Field ini wajib diisi',
            'ks_pestisida_jumlah_takaran' => '*Field ini wajib diisi',
        ]);

        $kspestisidas->update([
            'kegiatansawah_id' => $request->kegiatansawah_id,
            'lokasisawah_id' => $request->lokasisawah_id,
            'ks_pestisida_tgl_semprot' => $request->ks_pestisida_tgl_semprot,
            'pestisida_id' => $request->pestisida_id,
            'ks_pestisida_jumlah_takaran' => $dataHasilJumlahTakaranPestisida,
            'ks_pestisida_keterangan' => $request->ks_pestisida_keterangan
        ]);

        return redirect('/viewkegiatanpestisida')->with('success', 'Data berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $kspestisidas = Kspestisida::find($id);

        if (!$kspestisidas) {
            return redirect('/viewkegiatanpestisida')->with('error', 'Data tidak ditemukan');
        }

        $kspestisidas->delete();
        return redirect('/viewkegiatanpestisida')->with('success', 'Data berhasil dihapus');
    }
}
