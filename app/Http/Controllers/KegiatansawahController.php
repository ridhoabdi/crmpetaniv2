<?php

namespace App\Http\Controllers;

use App\Models\Kegiatansawah;
use App\Models\Lokasisawah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

class KegiatansawahController extends Controller
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
        if (!$lokasisawahs) {
            return view('/pages/respon/responlokasisawah');
        } else {
            $kegiatansawahs = DB::table('kegiatansawahs')
                ->join('lokasisawahs', 'kegiatansawahs.lokasisawah_id', '=', 'lokasisawahs.id')
                ->join('kabupatens', 'lokasisawahs.kabupaten_id', '=', 'kabupatens.id')
                ->select('kegiatansawahs.*', 'kabupatens.kabupaten_nama', 'lokasisawahs.lokasisawah_keterangan')
                ->where('kegiatansawahs.user_id', $user_id)
                ->where('kegiatansawahs.ks_panen', 0)
                ->get();

            // return dd($kegiatansawahs);
            return view('/pages/kegiatansawah/viewkegiatansawah', compact('kegiatansawahs'));
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
            ->get();

        $data['lokasisawahs'] = $lokasisawahs;

        // return dd($data);
        return view('/pages/kegiatansawah/addkegiatansawah', $data);
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

        // metode pengairan
        $ks_metode_pengairan = isset($_POST['ks_metode_pengairan']) && is_array($_POST['ks_metode_pengairan']) ? $_POST['ks_metode_pengairan'] : [];
        $input_ks_metode_pengairan = implode(', ', $ks_metode_pengairan);

        // jumlah bibit
        $jmlBibit = $request->input('ks_jumlah_bibit');
        $stnJmlbibit = $request->input('stnBibit');
        $dataHasiljumlahbibit = $jmlBibit;
        if ($stnJmlbibit == "Kuintal") {
            $dataHasiljumlahbibit = $dataHasiljumlahbibit * 100;
        }
        if ($stnJmlbibit == "Ton") {
            $dataHasiljumlahbibit = $dataHasiljumlahbibit * 1000;
        } else {
            $dataHasiljumlahbibit = $dataHasiljumlahbibit;
        }

        // luas lahan
        $satuanLuas_lahan = $request->input('stnLuasLahan');
        $dataLuas_lahan = $request->input('ks_luas_lahan');
        $dataHasilluaslahan = $dataLuas_lahan;
        if ($satuanLuas_lahan == "Hektar") {
            $dataHasilluaslahan = $dataHasilluaslahan * 10000;
        } else {
            $dataHasilluaslahan = $dataHasilluaslahan;
        }

        // status lahan
        $ks_status_lahan = isset($_POST['ks_status_lahan']) && is_array($_POST['ks_status_lahan']) ? $_POST['ks_status_lahan'] : [];
        $input_ks_status_lahan = implode(', ', $ks_status_lahan);

        // sumber modal
        $ks_sumber_modal = isset($_POST['ks_sumber_modal']) && is_array($_POST['ks_sumber_modal']) ? $_POST['ks_sumber_modal'] : [];
        $input_ks_sumber_modal = implode(', ', $ks_sumber_modal);

        // jumlah modal
        $ks_jumlah_modal = $request->input('ks_jumlah_modal');
        $ks_jumlah_modal = preg_replace("/[^0-9]/", "", $ks_jumlah_modal); // menghapus karakter selain angka
        $ks_jumlah_modal = intval($ks_jumlah_modal); // mengonversi nilai menjadi integer

        // form validasi
        $request->validate([
            'lokasisawah_id' => 'required|exists:lokasisawahs,id',
            'ks_waktu_tanam' => 'required',
            'ks_metode_pengairan' => 'required|min:1',
            'ks_jumlah_bibit' => 'required',
            'ks_luas_lahan' => 'required',
            'ks_status_lahan' => 'required',
            'ks_sumber_modal' => 'required',
            'ks_jumlah_modal' => 'required'
        ], [
            'lokasisawah_id' => '*Field ini wajib diisi',
            'ks_waktu_tanam' => '*Field ini wajib diisi',
            'ks_metode_pengairan' => '*Field ini wajib diisi',
            'ks_jumlah_bibit' => '*Field ini wajib diisi',
            'ks_luas_lahan' => '*Field ini wajib diisi',
            'ks_status_lahan' => '*Field ini wajib diisi',
            'ks_sumber_modal' => '*Field ini wajib diisi',
            'ks_jumlah_modal' => '*Field ini wajib diisi'
        ]);

        $kegiatansawahs = Kegiatansawah::create([
            'user_id' => $user_id,
            'lokasisawah_id' => $request->lokasisawah_id,
            'ks_waktu_tanam' => $request->ks_waktu_tanam,
            'ks_metode_pengairan' => $input_ks_metode_pengairan,
            'ks_jumlah_bibit' => $dataHasiljumlahbibit,
            'ks_luas_lahan' => $dataHasilluaslahan,
            'ks_status_lahan' => $input_ks_status_lahan,
            'ks_sumber_modal' => $input_ks_sumber_modal,
            'ks_jumlah_modal' => $ks_jumlah_modal,
            'ks_panen' => $request->ks_panen
        ]);

        return redirect('/viewkegiatansawah')->with('success', 'Data berhasil disimpan');
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

        $kegiatansawahs = Kegiatansawah::where('user_id', $user_id)
            ->find($id);

        if (!$kegiatansawahs) {
            return redirect('/viewkegiatansawah')->with('error', 'Data tidak ditemukan');
        }

        $lokasisawahs =  DB::table('lokasisawahs')
            ->join('kabupatens', 'kabupatens.id', '=', 'lokasisawahs.kabupaten_id')
            ->select('lokasisawahs.*', 'kabupatens.kabupaten_nama')
            ->orderBy('kabupaten_nama', 'ASC')
            ->orderBy('lokasisawah_keterangan', 'ASC')
            ->where('lokasisawahs.user_id', $user_id)
            ->get();

        $data['lokasisawahs'] = $lokasisawahs;
        $data['kegiatansawahs'] = $kegiatansawahs;

        // return dd($data);
        return view('pages/kegiatansawah/editkegiatansawah', $data);
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
        $kegiatansawahs = Kegiatansawah::where('id', $id)->where('user_id', auth()->user()->id)->first();

        if (!$kegiatansawahs) {
            return redirect('/viewkegiatansawah')->with('error', 'Data tidak ditemukan');
        }

        // metode pengairan
        $ks_metode_pengairan = isset($_POST['ks_metode_pengairan']) && is_array($_POST['ks_metode_pengairan']) ? $_POST['ks_metode_pengairan'] : [];
        $input_ks_metode_pengairan = implode(', ', $ks_metode_pengairan);

        // jumlah bibit
        $jmlBibit = $request->input('ks_jumlah_bibit');
        $stnJmlbibit = $request->input('stnBibit');
        $dataHasiljumlahbibit = $jmlBibit;
        if ($stnJmlbibit == "Kuintal") {
            $dataHasiljumlahbibit = $dataHasiljumlahbibit * 100;
        }
        if ($stnJmlbibit == "Ton") {
            $dataHasiljumlahbibit = $dataHasiljumlahbibit * 1000;
        } else {
            $dataHasiljumlahbibit = $dataHasiljumlahbibit;
        }

        // luas lahan
        $satuanLuas_lahan = $request->input('stnLuasLahan');
        $dataLuas_lahan = $request->input('ks_luas_lahan');
        $dataHasilluaslahan = $dataLuas_lahan;
        if ($satuanLuas_lahan == "Hektar") {
            $dataHasilluaslahan = $dataHasilluaslahan * 10000;
        } else {
            $dataHasilluaslahan = $dataHasilluaslahan;
        }

        // status lahan
        $ks_status_lahan = isset($_POST['ks_status_lahan']) && is_array($_POST['ks_status_lahan']) ? $_POST['ks_status_lahan'] : [];
        $input_ks_status_lahan = implode(', ', $ks_status_lahan);

        // sumber modal
        $ks_sumber_modal = isset($_POST['ks_sumber_modal']) && is_array($_POST['ks_sumber_modal']) ? $_POST['ks_sumber_modal'] : [];
        $input_ks_sumber_modal = implode(', ', $ks_sumber_modal);

        // jumlah modal
        $ks_jumlah_modal = $request->input('ks_jumlah_modal');
        $ks_jumlah_modal = preg_replace("/[^0-9]/", "", $ks_jumlah_modal); // menghapus karakter selain angka
        $ks_jumlah_modal = intval($ks_jumlah_modal); // mengonversi nilai menjadi integer

        $request->validate([
            'lokasisawah_id' => 'required|exists:lokasisawahs,id',
            'ks_waktu_tanam' => 'required',
            'ks_metode_pengairan' => 'required|min:1',
            'ks_jumlah_bibit' => 'required',
            'ks_luas_lahan' => 'required',
            'ks_status_lahan' => 'required',
            'ks_sumber_modal' => 'required',
            'ks_jumlah_modal' => 'required'
        ], [
            'lokasisawah_id' => '*Field ini wajib diisi',
            'ks_waktu_tanam' => '*Field ini wajib diisi',
            'ks_metode_pengairan' => '*Field ini wajib diisi',
            'ks_jumlah_bibit' => '*Field ini wajib diisi',
            'ks_luas_lahan' => '*Field ini wajib diisi',
            'ks_status_lahan' => '*Field ini wajib diisi',
            'ks_sumber_modal' => '*Field ini wajib diisi',
            'ks_jumlah_modal' => '*Field ini wajib diisi'
        ]);

        $kegiatansawahs->update([
            'lokasisawah_id' => $request->lokasisawah_id,
            'ks_waktu_tanam' => $request->ks_waktu_tanam,
            'ks_metode_pengairan' => $input_ks_metode_pengairan,
            'ks_jumlah_bibit' => $dataHasiljumlahbibit,
            'ks_luas_lahan' => $dataHasilluaslahan,
            'ks_status_lahan' => $input_ks_status_lahan,
            'ks_sumber_modal' => $input_ks_sumber_modal,
            'ks_jumlah_modal' => $ks_jumlah_modal,
            'ks_panen' => $request->ks_panen
        ]);

        return redirect('/viewkegiatansawah')->with('success', 'Data berhasil diedit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $kegiatansawahs = Kegiatansawah::find($id);

        if (!$kegiatansawahs) {
            return redirect('/viewkegiatansawah')->with('error', 'Data tidak ditemukan');
        }

        $kegiatansawahs->delete();
        return redirect('/viewkegiatansawah')->with('success', 'Data berhasil dihapus');
    }
}
