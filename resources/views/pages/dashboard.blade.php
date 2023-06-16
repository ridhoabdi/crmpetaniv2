@extends('layouts.mother')

@section('container')

<div class="row">
    <div class="col-md-12">
        <p class="h3 fw-bold">Perkiraan Cuaca</p>
        <p class="lead">Silahkan tambahkan lokasi agar mendapatkan perkiraan cuaca yang sesuai dengan lokasi Anda</p>
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

<!-- <p class="h3 fw-bold mt-4">Info Harga Bawang Merah Di Daerah "{{ $lokasisawahs->isNotEmpty() ? $lokasisawahs->first()->kabupaten_nama : '...' }}"</p>
<p class="lead">Di bawah ini tertera harga bawang merah yang berlaku di pasar</p>
<div class="row">
    <div class="col">
      <div class="card bg-danger">
        <div class="card-body">
          <p class="h3 fw-bold text-white">Harga Tertinggi</p>
          <p class="lead text-white">Rp .../kg</p>
        </div>
      </div>
    </div>
    <div class="col">
      <div class="card bg-primary">
        <div class="card-body">
          <p class="h3 fw-bold text-white">Harga Rata-rata</p>
          <p class="lead text-white">Rp .../kg</p>
        </div>
      </div>
    </div>
    <div class="col">
      <div class="card bg-success">
        <div class="card-body">
          <p class="h3 fw-bold text-white">Harga Terendah</p>
          <p class="lead text-white">Rp .../kg</p>
        </div>
      </div>
    </div>
</div> -->
  

<p class="h3 fw-bold mt-4">Aktivitas Petani Bawang Merah</p>
<p class="lead">Silahkan mengisi rangkaian kegiatan pertanian bawang dengan terstruktur untuk memperoleh hasil panen yang optimal</p>
<div class="row mt-2">
    <div class="col">
        <a href="{{ url('/viewlokasisawah/') }}" style="text-decoration: none;">
            <div class="card" style="position: relative; text-align: center; background-color: #3be102;">
                <div class="card-body" style="display: flex; align-items: center; justify-content: center;">
                    <div style="position: absolute; top: 0; left: 0; width: 40px; height: 40px; background-color: #7b6bf4; color: #fff; font-weight: bold; font-size: 20px; text-align: center; line-height: 30px; border-radius: 5px;">
                        1
                    </div>
                    <h3 class="fw-medium text-dark mb-0 mt-2" style="font-size: 23px;">Lokasi Sawah</h3>
                </div>
            </div>
        </a>
    </div>
    <div class="col">
        <a href="{{ url('/viewkegiatansawah/') }}" style="text-decoration: none;">
            <div class="card" style="position: relative; text-align: center; background-color: #ff7ff0;">
                <div class="card-body" style="display: flex; align-items: center; justify-content: center;">
                    <div style="position: absolute; top: 0; left: 0; width: 40px; height: 40px; background-color: #7b6bf4; color: #fff; font-weight: bold; font-size: 20px; text-align: center; line-height: 30px; border-radius: 5px;">
                        2
                    </div>
                    <h3 class="fw-medium text-dark mb-0 mt-2" style="font-size: 23px;">Penanaman Bawang</h3>
                </div>
            </div>
        </a>
    </div>
    <div class="col">
        <a href="{{ url('/viewkegiatanpupuk/') }}" style="text-decoration: none;">
            <div class="card" style="position: relative; text-align: center; background-color: #ffd700;">
                <div class="card-body" style="display: flex; align-items: center; justify-content: center;">
                    <div style="position: absolute; top: 0; left: 0; width: 40px; height: 40px; background-color: #7b6bf4; color: #fff; font-weight: bold; font-size: 20px; text-align: center; line-height: 30px; border-radius: 5px;">
                        3
                    </div>
                    <h3 class="fw-medium text-dark mb-0 mt-2" style="font-size: 23px;">Kegiatan Pupuk</h3>
                </div>
            </div>
        </a>
    </div>
</div>
<div class="row mt-4">
    <div class="col">
        <a href="{{ url('/viewkegiatanpestisida/') }}" style="text-decoration: none;">
            <div class="card" style="position: relative; text-align: center; background-color: #96cbff;">
                <div class="card-body" style="display: flex; align-items: center; justify-content: center;">
                    <div style="position: absolute; top: 0; left: 0; width: 40px; height: 40px; background-color: #7b6bf4; color: #fff; font-weight: bold; font-size: 20px; text-align: center; line-height: 30px; border-radius: 5px;">
                        4
                    </div>
                    <h3 class="fw-medium text-dark mb-0 mt-2" style="font-size: 23px;">Kegiatan Pestisida</h3>
                </div>
            </div>
        </a>
    </div>
    <div class="col">
        <a href="{{ url('/viewpanen/') }}" style="text-decoration: none;">
            <div class="card" style="position: relative; text-align: center; background-color: #ff9899;">
                <div class="card-body" style="display: flex; align-items: center; justify-content: center;">
                    <div style="position: absolute; top: 0; left: 0; width: 40px; height: 40px; background-color: #7b6bf4; color: #fff; font-weight: bold; font-size: 20px; text-align: center; line-height: 30px; border-radius: 5px;">
                        5
                    </div>
                    <h3 class="fw-medium text-dark mb-0 mt-2" style="font-size: 23px;">Hasil Panen</h3>
                </div>
            </div>
        </a>
    </div>
    <div class="col">
        <a href="{{ url('/viewriwayatpanen') }}" style="text-decoration: none;">
            <div class="card" style="position: relative; text-align: center; background-color: #edc9af;">
                <div class="card-body" style="display: flex; align-items: center; justify-content: center;">
                    <div style="position: absolute; top: 0; left: 0; width: 40px; height: 40px; background-color: #7b6bf4; color: #fff; font-weight: bold; font-size: 20px; text-align: center; line-height: 30px; border-radius: 5px;">
                        6
                    </div>
                    <h3 class="fw-medium text-dark mb-0 mt-2" style="font-size: 23px;">Riwayat Panen</h3>
                </div>
            </div>
        </a>
    </div>
</div>

<style>
  .card:hover {
    cursor: pointer;
    /* box-shadow: 0 0 10px rgba(0, 0, 0, 0.3); */
    transform: scale(1.05);
    transition: all 0.3s ease-in-out;
  }

  .card:active {
    transform: scale(1.01);
    transition: all 0.1s ease-in-out;
  }

  .card-body {
    height: 150px;
  }

</style>


<!-- <div class="row">
<div class="col">
    <div class="card bg-">
    <div class="card-body">
        <p class="h3 fw-bold text-white">Prediksi Kapan Pupuk</p>
        <p class="lead text-white">Tgl :</p>
    </div>
    </div>
</div>

<div class="col">
    <div class="card bg-secondary">
    <div class="card-body">
        <p class="h3 fw-bold text-white">Prediksi Kapan Pestisida</p>
        <p class="lead text-white">Tgl :</p>
    </div>
    </div>
</div>

<div class="col">
    <div class="card bg-warning">
    <div class="card-body">
        <p class="h3 fw-bold text-white">Prediksi Kapan Panen</p>
        <p class="lead text-white">Tgl :</p>
    </div>
    </div>
</div>
</div> -->
</div>


<p class="h3 fw-bold mt-5">Data Sensor IoT</p>
<p class="lead">Silahkan tambahkan lokasi sawah terlebih dahulu jika data sensor IoT belum ada</p>
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

</div>
<div>

        <!-- <p class="h3 fw-bold">History IoT diladang Anda</p> -->
        <!-- <p class="lead">Silahkan tambahkan lokasi jika data history iot belum ada</p>
        <p class="card-title">Table IoT</p>

        <div class="row">
            <div>
            </div>
            <div class="col-12">
                <div class="table-responsive">
                    <table id="table" class="display expandable-table" style="width:100%">
                        <thead>
                            <tr>
                                <th scope="col">NO</th>
                                <th scope="col">Id_iot</th>
                                <th scope="col">Alamat Daerah</th>
                                <th scope="col">Data Kecepatan Angin</th>
                                <th scope="col">Data Suhu Udara</th>
                                <th scope="col">Data Kelembaban Udara</th>
                                <th scope="col">Data Ph Tanah</th>
                                <th scope="col">Data Kelembaban Tanah</th>
                                <th scope="col">Data Suhu Tanah</th>
                                <th scope="col">Status Alat</th>
                                <th scope="col">Waktu</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- @foreach ($data as $dataiot)
                                <tr>
                                    <th scope="row">{{ $dataiot->id }}</th>
                                    <td>{{ $dataiot->id_iot }}</td>
                                    <td>{{ $dataiot->alamat }}</td>
                                    <td>{{ $dataiot->datakecepatanangin }}</td>
                                    <td>{{ $dataiot->datasuhuudara }}</td>
                                    <td>{{ $dataiot->datakelembabanudara }}</td>
                                    <td>{{ $dataiot->dataphtanah }}</td>
                                    <td>{{ $dataiot->datakelembabantanah }}</td>
                                    <td>{{ $dataiot->datasuhutanah }}</td>
                                    <td>{{ $dataiot->statusalat }}</td>
                                    <td>{{ $dataiot->tanggal }}</td>
                                </tr>
                            @endforeach --}}
                        </tbody>

                    </table>
                </div>

                <div>
                </div>
            </div>
        </div> -->
</div>


@endsection