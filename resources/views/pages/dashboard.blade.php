@extends('layouts.mother')

@section('container')

<div class="row">
    <div class="col-md-12">
        <p class="h3 fw-bold">Prediksi Cuaca</p>
        <p class="lead">Silahkan tambahkan lokasi agar mendapatkan prediksi cuaca yang sesuai dengan lokasi anda atau silahkan ijinkan akses lokasi di hp anda.</p>
        <a class="weatherwidget-io d-block mt-3" href="https://forecast7.com/en/n7d01110d44/semarang/"
        data-label_1="SEMARANG" data-label_2="WEATHER" data-days="3"
        data-theme="pure">SEMARANG WEATHER</a>
        <script>
            ! function(d, s, id) {
                var js, fjs = d.getElementsByTagName(s)[0];
                if (!d.getElementById(id)) {
                    js = d.createElement(s);
                    js.id = id;
                    js.src = 'https://weatherwidget.io/js/widget.min.js';
                    fjs.parentNode.insertBefore(js, fjs);
                }
            }(document, 'script', 'weatherwidget-io-js');
        </script>
      </div>
</div>

<div>




</div>
<p class="h3 fw-bold">Daftar Harga Bawang Merah Dipasar</p>
{{-- <p class="lead">Silahkan tambahkan Kegiatan Sawah</p> --}}
<div class="row">
    <div class="col">
      <div class="card bg-primary">
        <div class="card-body">
          <p class="h3 fw-bold text-white">Info Harga Bawang Merah Di Daerah "Jakarta"</p>
          <p class="lead text-white">Harga Rata Rata Rp 50.109/kg</p>
        </div>
      </div>
    </div>
  
    <div class="col">
      <div class="card bg-success">
        <div class="card-body">
          <p class="h3 fw-bold text-white">Harga Tertinggi</p>
          <p class="lead text-white">Rp 65.000/kg</p>
        </div>
      </div>
    </div>
  
    <div class="col">
      <div class="card bg-danger">
        <div class="card-body">
          <p class="h3 fw-bold text-white">Harga Terendah</p>
          <p class="lead text-white">Rp 35.000/kg</p>
        </div>
      </div>
    </div>
  </div>
  

<p class="h3 fw-bold">Prediksi</p>
<p class="lead">Silahkan tambahkan Kegiatan Sawah</p>
{{-- <p class="card-title">Table IoT</p> --}}

  <div class="row">
    <div class="col">
      <div class="card bg-info">
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
  </div>
  
</div>
<p class="h3 fw-bold">Data IoT Sekarang</p>
<p class="lead">Silahkan tambahkan lokasi jika data Sensor iot belum ada</p>
<div class="row">
    {{-- @foreach ($data as $item['iot']); --}}
        <div class="container py-5">
            <div class="row">
                {{-- <div class="col-lg-12 mx-auto mb-5 text-white text-center">
                    <h1 class="display-4">Laporan Sensor IoT</h1>
                    <h1 class="display-4">ID IOT {{ $item['iot']['iot']['id_iot'] }} </h1>

                    <p class="lead mb-0">Monitor Sensor IoT</p>
                    <p class="lead mb-0">Waktu {{ $item['iot']['iot']['tanggal'] }} </p>

                </div> --}}
                <!-- END -->

                <div class="col-xl-3 col-lg-6 mb-4">
                    <div class="bg-white rounded-lg p-5 shadow">
                        <h2 class="h6 font-weight-bold text-center mb-4">Data Kecepatan Angin</h2>

                        <!-- Progress bar 1 -->
                       <div class="progress mx-auto"
                            data-value=10>
                            <span class="progress-left">
                                <span class="progress-bar border-primary"></span>
                            </span>
                            <span class="progress-right">
                                <span class="progress-bar border-primary"></span>
                            </span>
                            <div
                                class="progress-value w-100 h-100 rounded-circle d-flex align-items-center justify-content-center">
                                <div class="h2 font-weight-bold">
                                    10<sup
                                        class="small">km/h</sup></div>
                            </div>
                        </div> 
                    </div>
                </div>

                <div class="col-xl-3 col-lg-6 mb-4">
                    <div class="bg-white rounded-lg p-5 shadow">
                        <h2 class="h6 font-weight-bold text-center mb-4">Data Suhu Udara</h2>

                        <!-- Progress bar 2 -->
                        {{-- <div class="progress mx-auto" data-value={{ $item['iot']['iot']['datasuhuudara'] }}>
                            <span class="progress-left">
                                <span class="progress-bar border-danger"></span>
                            </span>
                            <span class="progress-right">
                                <span class="progress-bar border-primary"></span>
                            </span>
                            <div
                                class="progress-value w-100 h-100 rounded-circle d-flex align-items-center justify-content-center">
                                <div class="h2 font-weight-bold">{{ $item['iot']['iot']['datasuhuudara'] }}<sup
                                        class="small">c</sup></div>
                            </div>
                        </div> --}}
                        <!-- END -->

                        <!-- END -->
                    </div>
                </div>


                <div class="col-xl-3 col-lg-6 mb-4">
                    <div class="bg-white rounded-lg p-5 shadow">
                        <h2 class="h6 font-weight-bold text-center mb-4">Data Kelembaban Udara</h2>

                        <!-- Progress bar 3 -->
                        {{-- <div class="progress mx-auto"
                            data-value={{ $item['iot']['iot']['datakelembabanudara'] }}>
                            <span class="progress-left">
                                <span class="progress-bar border-success"></span>
                            </span>
                            <span class="progress-right">
                                <span class="progress-bar border-primary"></span>
                            </span>
                            <div
                                class="progress-value w-100 h-100 rounded-circle d-flex align-items-center justify-content-center">
                                <div class="h2 font-weight-bold">
                                    {{ $item['iot']['iot']['datakelembabanudara'] }}<sup class="small">c</sup>
                                </div>
                            </div>
                        </div> --}}
                    </div>
                </div>

                <div class="col-xl-3 col-lg-6 mb-4">
                    <div class="bg-white rounded-lg p-5 shadow">
                        <h2 class="h6 font-weight-bold text-center mb-4">Data Suhu Tanah</h2>

                        <!-- Progress bar 3 -->
                        {{-- <div class="progress mx-auto" data-value='{{ $item['iot']['iot']['datasuhutanah'] }}'>
                            <span class="progress-left">
                                <span class="progress-bar border-success"></span>
                            </span>
                            <span class="progress-right">
                                <span class="progress-bar border-primary"></span>
                            </span>
                            <div
                                class="progress-value w-100 h-100 rounded-circle d-flex align-items-center justify-content-center">
                                <div class="h2 font-weight-bold">{{ $item['iot']['iot']['datasuhutanah'] }}<sup
                                        class="small">c</sup></div>
                            </div>
                        </div> --}}
                    </div>
                </div>

                <div class="col-xl-3 col-lg-6 mb-4">
                    <div class="bg-white rounded-lg p-5 shadow">
                        <h2 class="h6 font-weight-bold text-center mb-4">datakelembabantanah</h2>

                        <!-- Progress bar 3 -->
                        {{-- <div class="progress mx-auto"
                            data-value={{ $item['iot']['iot']['datakelembabantanah'] }}>
                            <span class="progress-left">
                                <span class="progress-bar border-success"></span>
                            </span>
                            <span class="progress-right">
                                <span class="progress-bar border-primary"></span>
                            </span>
                            <div
                                class="progress-value w-100 h-100 rounded-circle d-flex align-items-center justify-content-center">
                                <div class="h2 font-weight-bold">
                                    {{ $item['iot']['iot']['datakelembabantanah'] }}<sup class="small">c</sup>
                                </div>
                            </div>
                        </div> --}}
                    </div>
                </div>

                <div class="col-xl-3 col-lg-6 mb-4">
                    {{-- <div class="bg-white rounded-lg p-5 shadow">
                        <h2 class="h6 font-weight-bold text-center mb-4">Data Ph tanah</h2>

                        <!-- Progress bar 4 -->
                        <div class="progress mx-auto" data-value={{ $item['iot']['iot']['dataphtanah'] }}>
                            <span class="progress-left">
                                <span class="progress-bar border-warning"></span>
                            </span>
                            <span class="progress-right">
                                <span class="progress-bar border-primary"></span>
                            </span>
                            <div
                                class="progress-value w-100 h-100 rounded-circle d-flex align-items-center justify-content-center">
                                <div class="h2 font-weight-bold">{{ $item['iot']['iot']['dataphtanah'] }} <sup
                                        class="small">pH</sup></div>
                            </div>
                        </div>
                    </div> --}}
                </div>

                <div class="col-xl-3 col-lg-6 mb-4">
                    <div class="bg-white  p-5 shadow">
                        {{-- <div class="card-body">
                            <p class="h6 font-weight-bold text-center mb-4">Status Alat<br></p>

                            @if ($item['iot']['iot']['statusalat'] == 1)
                                <center>
                                    <p class="h2 font-weight-bold">Hidup</p>
                                </center>
                            @else
                                <center>
                                    <p class="h2 font-weight-bold">Mati </p>
                                </center>
                            @endif
                        </div> --}}
                    </div>
                </div>

                <div class="col-xl-3 col-lg-6 mb-4">
                    <div class="bg-white  p-5 shadow">
                        {{-- <div class="card-body">
                            <p class="h6 font-weight-bold text-center mb-4">Alamat Sensor Iot<br></p>

                            <center>
                                <p class="h2 font-weight-bold">{{ $item['iot']['iot']['alamat'] }}</p>
                            </center>


                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
</div>

</div>
<div>

<p class="h3 fw-bold">History IoT diladang Anda</p>
        <p class="lead">Silahkan tambahkan lokasi jika data history iot belum ada</p>
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
        </div>

</div>


@endsection