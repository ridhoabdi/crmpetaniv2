<?php

namespace App\Http\Controllers;

use App\Models\Lokasisawah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class InfoController extends Controller
{
    // menampilkan perkiraan cuaca dan sensor iot pada dashboard
    public function showSensorIotdanCuaca()
    {
        // get data perkiraan cuaca
        $user_id = auth()->user()->id;
        $lokasisawahs = Lokasisawah::where('user_id', $user_id)
            ->join('kabupatens', 'kabupatens.id', '=', 'lokasisawahs.kabupaten_id')
            ->select('lokasisawahs.*', 'kabupatens.kabupaten_nama', 'kabupatens.kabupaten_kode')
            ->get();
        
        // get data sensor iot
        $iot_id = Lokasisawah::where('user_id', $user_id)
            // ->where('lokasisawah_status', 0)
            ->value('iot_id');

        $url = "http://34.142.156.17:900/api/get/dataiot/$iot_id";

        $response = Http::get($url);
        $dataiot = $response->json();

        // return dd($lokasisawahs, $dataiot);

        return view('pages.dashboard', compact('lokasisawahs', 'dataiot'));
    }
    
    // menampilkan perkiraan cuaca dan sensor iot pada menu IoT
    public function viewiotdancuaca()
    {
        $user_id = auth()->user()->id;
        $lokasisawahs = Lokasisawah::where('user_id', $user_id)->first();
        if (!$lokasisawahs) {
            return view('/pages/respon/responlokasisawah');
        } else {
            // get perkiraan cuaca
            $lokasisawahs = Lokasisawah::where('user_id', $user_id)
                ->join('kabupatens', 'kabupatens.id', '=', 'lokasisawahs.kabupaten_id')
                ->select('lokasisawahs.*', 'kabupatens.kabupaten_nama', 'kabupatens.kabupaten_kode')
                ->get();

            // get data sensor iot
            $iot_id = Lokasisawah::where('user_id', $user_id)
                ->value('iot_id');

            $url = "http://34.142.156.17:900/api/get/dataiot/$iot_id";

            $response = Http::get($url);
            $dataiot = $response->json();

            return view('pages.iot.viewiotdancuaca', compact('lokasisawahs', 'dataiot'));
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
