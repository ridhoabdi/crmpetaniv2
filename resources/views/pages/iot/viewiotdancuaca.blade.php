@extends('layouts.mother')

@section('container')

<div class="row">
    <div class="col-md-12">
        <p class="h3 fw-bold mb-3">Perkiraan Cuaca</p>
        <script>
            (function(d, s, id) {
                if (d.getElementById(id)) {
                    if (window.__TOMORROW__) {
                        window.__TOMORROW__.renderWidget();
                    }
                    return;
                }
                const fjs = d.getElementsByTagName(s)[0];
                const js = d.createElement(s);
                js.id = id;
                js.src = "https://www.tomorrow.io/v1/widget/sdk/sdk.bundle.min.js";

                fjs.parentNode.insertBefore(js, fjs);
            })(document, 'script', 'tomorrow-sdk');
        </script>

        <div class="tomorrow"
           data-location-id="{{ $lokasisawahs->isNotEmpty() ? $lokasisawahs->first()->kabupaten_kode : '056378' }}"
           data-language="ID"
           data-unit-system="METRIC"
           data-skin="light"
           data-widget-type="upcoming"
           style="padding-bottom:22px;position:relative;">
        </div>
    </div>
</div>

<p class="h3 fw-bold mt-3 mb-3">Data Sensor IoT</p>
<div class="row">
    <div class="col-xl-3 col-lg-6 mb-4">
        <div class="bg-white rounded-lg p-5 shadow">
            <h2 class="h6 font-weight-bold text-center mb-4">ID IoT</h2>
            <h4 class="text-center">{{ $dataiot[0]['id_iot'] ?? 'Data tidak tersedia' }}</h4>
        </div>
    </div>  
    <div class="col-xl-3 col-lg-6 mb-4">
        <div class="bg-white rounded-lg p-5 shadow">
            <h2 class="h6 font-weight-bold text-center mb-4">Data Kecepatan Angin</h2>
            <h4 class="text-center">{{ isset($dataiot[0]['datakecepatanangin']) ? $dataiot[0]['datakecepatanangin'].' m/s' : 'Data tidak tersedia' }}</h4>

        </div>
    </div>

    <div class="col-xl-3 col-lg-6 mb-4">
        <div class="bg-white rounded-lg p-5 shadow">
            <h2 class="h6 font-weight-bold text-center mb-4">Data Suhu Udara</h2>
            <h4 class="text-center">{{ isset($dataiot[0]['datasuhuudara']) ? $dataiot[0]['datasuhuudara'].' °C' : 'Data tidak tersedia' }}</h4>
        </div>
    </div> 
    
    <div class="col-xl-3 col-lg-6 mb-4">
        <div class="bg-white rounded-lg p-5 shadow">
            <h2 class="h6 font-weight-bold text-center mb-4">Data Kelembaban Udara</h2>
            <h4 class="text-center">{{ isset($dataiot[0]['datakelembabanudara']) ? $dataiot[0]['datakelembabanudara'].' %' : 'Data tidak tersedia' }}</h4>
        </div>
    </div>  

    <div class="col-xl-3 col-lg-6 mb-4">
        <div class="bg-white rounded-lg p-5 shadow">
            <h2 class="h6 font-weight-bold text-center mb-4">Data pH Tanah</h2>
            <h4 class="text-center">{{ isset($dataiot[0]['dataphtanah']) ? $dataiot[0]['dataphtanah'].' pH' : 'Data tidak tersedia' }}</h4>
        </div>
    </div>  

    <div class="col-xl-3 col-lg-6 mb-4">
        <div class="bg-white rounded-lg p-5 shadow">
            <h2 class="h6 font-weight-bold text-center mb-4">Data Kelembaban Tanah</h2>
            <h4 class="text-center">{{ isset($dataiot[0]['datakelembabantanah']) ? $dataiot[0]['datakelembabantanah'].' %' : 'Data tidak tersedia' }}</h4>
        </div>
    </div>  

    <div class="col-xl-3 col-lg-6 mb-4">
        <div class="bg-white rounded-lg p-5 shadow">
            <h2 class="h6 font-weight-bold text-center mb-4">Data Suhu Tanah</h2>
            <h4 class="text-center">{{ isset($dataiot[0]['datasuhutanah']) ? $dataiot[0]['datasuhutanah'].' °C' : 'Data tidak tersedia' }}</h4>
        </div>
    </div>  

    <div class="col-xl-3 col-lg-6 mb-4">
        <div class="bg-white rounded-lg p-5 shadow">
            <h2 class="h6 font-weight-bold text-center mb-4">Status Alat</h2>
            <h4 class="text-center">
                @if(isset($dataiot[0]['statusalat']))
                    @if($dataiot[0]['statusalat'])
                        Hidup
                    @else
                        Mati
                    @endif
                @else
                    Data tidak tersedia
                @endif
            </h4>
        </div>
    </div>
</div>

@endsection