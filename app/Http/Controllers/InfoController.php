<?php

namespace App\Http\Controllers;

use App\Models\Lokasisawah;
use Illuminate\Http\Request;

class InfoController extends Controller
{
    // menampilkan perkiraan cuaca pada halaman DASHBOARD
    public function showperkiraancuaca()
    {
        $user_id = auth()->user()->id;
        $lokasisawahs = Lokasisawah::where('user_id', $user_id)
            ->join('kabupatens', 'kabupatens.id', '=', 'lokasisawahs.kabupaten_id')
            ->select('lokasisawahs.*', 'kabupatens.kabupaten_nama', 'kabupatens.kabupaten_kode')
            ->get();

        // return dd($lokasisawahs);
        return view('pages.dashboard', compact('lokasisawahs'));
    }

    // menampilkan perkiraan cuaca pada halaman PAGES.IOT.PERKIRAANCUACA
    public function viewperkiraancuaca()
    {
        $user_id = auth()->user()->id;
        $lokasisawahs = Lokasisawah::where('user_id', $user_id)->first();
        if (!$lokasisawahs) {
            return view('/pages/respon/responlokasisawah');
        } else {
            $lokasisawahs = Lokasisawah::where('user_id', $user_id)
                ->join('kabupatens', 'kabupatens.id', '=', 'lokasisawahs.kabupaten_id')
                ->select('lokasisawahs.*', 'kabupatens.kabupaten_nama', 'kabupatens.kabupaten_kode')
                ->get();
            return view('pages.iot.viewperkiraancuaca', compact('lokasisawahs'));
        }
    }

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
