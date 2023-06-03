@extends('layouts.mother')

@section('container')

@if (session('success'))
    <div id="success-alert" class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<script>
    setTimeout(function() {
        $('#success-alert').fadeOut('slow');
    }, 3000); // menampilkan notifikasi selama 3 detik
</script>

@if (session('error'))
    <div id="error-alert" class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

<script>
    setTimeout(function() {
        $('#error-alert').fadeOut('slow');
    }, 5000); // menampilkan notifikasi selama 5 detik
</script>

<style>
     /* Mengatur warna header tabel menjadi ungu */
     #table thead th {
        background-color: #6f42c1; /* Warna ungu, ganti sesuai kebutuhan */
    }

    /* Mengatur warna teks pada header tabel menjadi putih */
    #table thead th {
        color: #ffffff; /* Warna putih, ganti sesuai kebutuhan */
    }

    /* Mengatur warna baris tabel */
    #table tbody tr {
        background-color: #ffffff; /* ganti warna sesuai kebutuhan */
    }

    /* Mengatur warna baris ganjil tabel */
    #table tbody tr:nth-child(odd) {
        background-color: #f8f9fa; /* ganti warna sesuai kebutuhan */
    }

    /* Mengatur warna saat hover pada baris tabel */
    #table tbody tr:hover {
        background-color: #f0f0f0; /* ganti warna sesuai kebutuhan */
    }

    /* Mengatur warna pada tombol unduh */
    .btn-outline-success {
        color: #28a745; /* ganti warna sesuai kebutuhan */
        border-color: #28a745; /* ganti warna sesuai kebutuhan */
    }

    /* Mengatur margin pada tombol unduh */
    .btn-outline-success {
        margin-top: 5px; /* ganti margin sesuai kebutuhan */
        margin-bottom: 5px; /* ganti margin sesuai kebutuhan */
    }
</style>

<div class="card p-3 shadow-sm">
    <div class="card-header">
        <h5>Riwayat Panen</h5>
    </div>
    <ul class="list-group mt-3">
        <div class="card-header">
            <p class="" style="font-size: larger;">Berikut adalah riwayat panen dari kegiatan penanaman bawang merah yang telah Bapak/Ibu lakukan. <br> Silakan klik ikon <i class="menu-icon mdi mdi-eye-outline"></i> untuk melihat detail riwayat panen. </p>
        </div>
        <li class="list-group-item mt-3">
            <div class="row table-responsive">
                <table class="table table-bordered" id="table">
                    <thead>
                        <tr>
                            <th>Tanggal Panen</th>
                            <th>Waktu Tanam</th>
                            <th>Varietas Bawang</th>
                            <th>Jumlah Bibit</th>
                            <th>Jumlah Modal</th>
                            <th>Jumlah Panen</th>
                            <th>Harga Panen</th>
                            <th>Kabupaten</th>
                            <!-- <th>Keterangan Lokasi Sawah</th> -->
                            <!-- <th>Unduh</th> -->
                            <th>Detail</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($panens as $riwayatpanen)
                            <tr>
                                <td>{{ \Carbon\Carbon::parse($riwayatpanen->panen_tanggal)->translatedFormat('l, d F Y') }}</td>
                                <td>{{ \Carbon\Carbon::parse($riwayatpanen->ks_waktu_tanam)->translatedFormat('l, d F Y') }}</td>
                                <td>{{ $riwayatpanen->varietasbawang_nama }}</td>
                                <td>{{ number_format($riwayatpanen->ks_jumlah_bibit, 0, ',', '.') }} kg</td>
                                <td>{{ 'Rp. ' . number_format($riwayatpanen->ks_jumlah_modal, 0, ',', '.') }}</td>
                                <td>{{ number_format($riwayatpanen->panen_jumlah, 0, ',', '.') }} kg</td>
                                <td>{{ 'Rp ' . number_format($riwayatpanen->panen_harga, 0, ',', '.') }}</td>
                                <td>{{ $riwayatpanen->kabupaten_nama }}</td>
                                <!-- <td>{{ $riwayatpanen->lokasisawah_keterangan }}</td> -->
                                <!-- <td>
                                    <a href="/pdfriwayatpanen/{{$riwayatpanen->id}}" class="btn btn-sm btn-outline-success mt-1">
                                        <i class="menu-icon mdi mdi-download"></i> Unduh
                                    </a>
                                </td> -->
                                <td>
                                    <a href="/detailriwayatpanen/{{$riwayatpanen->id}}" class="btn btn-sm btn-outline-warning mt-1">
                                        <i class="menu-icon mdi mdi-eye-outline"></i> Lihat Detail
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </li>
    </ul>
</div>

@endsection