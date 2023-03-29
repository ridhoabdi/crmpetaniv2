<?php

namespace App\Http\Controllers;

use App\Models\Lokasisawah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LokasisawahController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = auth()->user()->id;
        $lokasisawahs = Lokasisawah::where('user_id', $user_id)
            ->join('kabupatens', 'kabupatens.id', '=', 'lokasisawahs.kabupaten_id')
            ->select('lokasisawahs.*', 'kabupatens.kabupaten_nama')
            ->get();

        // return dd($lokasisawahs);
        return view('/pages/lokasisawah/viewlokasisawah', compact('lokasisawahs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user_id = auth()->user()->id;
        $kabupatens = DB::table('kabupatens')->orderBy('kabupaten_nama', 'ASC')->get();
        $data['kabupatens'] = $kabupatens;
        // return dd($data);
        return view('pages/lokasisawah/addlokasisawah', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Menginputkan data hanya 1 kali

        $user_id = auth()->user()->id;

        // Cek jumlah data lokasi yang dimiliki oleh user
        $lokasi_count = Lokasisawah::where('user_id', $user_id)->count();

        // Jika jumlah data kurang dari atau sama dengan 1, simpan data
        if ($lokasi_count < 1) {
            $request->validate([
                'kabupaten_id' => 'required|exists:kabupatens,id'
            ], [
                'kabupaten_id' => '*Field ini wajib diisi'
            ]);

            $lokasisawahs = Lokasisawah::create([
                'user_id' => $user_id,
                'lokasisawah_latitude' => $request->lokasisawah_latitude,
                'lokasisawah_longitude' => $request->lokasisawah_longitude,
                'kabupaten_id' => $request->kabupaten_id,
                'lokasisawah_keterangan' => $request->lokasisawah_keterangan,
            ]);

            return redirect('/viewlokasisawah')->with('success', 'Data berhasil disimpan');
            
        } else {
            // Jika jumlah data lebih dari 1, tampilkan pesan error
            return redirect('/viewlokasisawah')->with('error', 'Maaf, Anda hanya dapat menambahkan 1 lokasi sawah');
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

        $lokasisawahs = Lokasisawah::where('user_id', $user_id)
            ->find($id);
    
        if (!$lokasisawahs) {
            return redirect('/viewlokasisawah')->with('error', 'Data tidak ditemukan');
        }
    
        $kabupatens = DB::table('kabupatens')->orderBy('kabupaten_nama', 'ASC')->get();
        $data['kabupatens'] = $kabupatens;
        $data['lokasisawahs'] = $lokasisawahs;
        
        // return dd($data);
        return view('pages/lokasisawah/editlokasisawah', $data);
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
        $lokasisawahs = Lokasisawah::where('id', $id)->where('user_id', auth()->user()->id)->first();

        if (!$lokasisawahs) {
            return redirect('/viewlokasisawah')->with('error', 'Data tidak ditemukan');
        }

        $request->validate([
            'kabupaten_id' => 'required|exists:kabupatens,id'
        ], [
            'kabupaten_id' => '*Field ini wajib diisi'
        ]);

        $lokasisawahs->update([
            'lokasisawah_latitude' => $request->lokasisawah_latitude,
            'lokasisawah_longitude' => $request->lokasisawah_longitude,
            'kabupaten_id' => $request->kabupaten_id,
            'lokasisawah_keterangan' => $request->lokasisawah_keterangan,
        ]);

        return redirect('/viewlokasisawah')->with('success', 'Data berhasil diedit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $lokasisawahs = Lokasisawah::find($id);

        if (!$lokasisawahs) {
            return redirect('/viewlokasisawah')->with('error', 'Data tidak ditemukan');
        }

        $lokasisawahs->delete();
        return redirect('/viewlokasisawah')->with('success', 'Data berhasil dihapus');
    }
}
