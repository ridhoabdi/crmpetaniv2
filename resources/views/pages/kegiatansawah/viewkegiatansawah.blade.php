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

<div class="card p-3 shadow-sm">
    <div class="card-header">
        <h5>Data Kegiatan Penanaman Bawang</h5>
        <a href="/addkegiatansawah" class="btn btn-sm btn-outline-success mt-1">
            <i class="menu-icon mdi mdi-plus"></i> Tambah data
        </a>
    </div>
    <ul class="list-group mt-3">
        @foreach ($kegiatansawahs as $kegiatansawah)
            <li class="list-group-item mt-3">
                <div class="row">
                    <div class="col-md-8">
                        <table>
                            <tr>
                                <th style="width: 180px;">Waktu Tanam</th>
                                <td>{{ \Carbon\Carbon::parse($kegiatansawah->ks_waktu_tanam)->translatedFormat('l, d F Y') }}</td>
                            </tr>
                            <tr>
                                <th style="width: 180px;">Metode Pengairan</th>
                                <td>{{ $kegiatansawah->ks_metode_pengairan}}</td>
                            </tr>
                            <tr>
                                <th style="width: 180px;">Jumlah Bibit</th>
                                <td>{{ number_format($kegiatansawah->ks_jumlah_bibit, 0, ',', '.') }} kg</td>
                            </tr>
                            <tr>
                                <th style="width: 180px;">Luas Lahan</th>
                                <td>{{ number_format($kegiatansawah->ks_luas_lahan, 0, ',', '.') }} m<sup>2</sup></td>
                            </tr>
                            <tr>
                                <th style="width: 180px;">Status Lahan</th>
                                <td>{{ $kegiatansawah->ks_status_lahan}}</td>
                            </tr>
                            <tr>
                                <th style="width: 180px;">Sumber Modal</th>
                                <td>{{ $kegiatansawah->ks_sumber_modal}}</td>
                            </tr>
                            <tr>
                                <th style="width: 180px;">Jumlah Modal</th>
                                <td>{{ 'Rp ' . number_format($kegiatansawah->ks_jumlah_modal, 0, ',', '.') }}</td>
                            </tr>
                            <tr>
                                <th style="width: 180px;">Kabupaten</th>
                                <td>{{ $kegiatansawah->kabupaten_nama }}</td>
                            </tr>
                            <tr>
                                <th style="width: 180px;">Alamat Lokasi Sawah</th>
                                <td>{{ $kegiatansawah->lokasisawah_keterangan}}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-4">
                        <div class="d-flex justify-content-end">
                            <a href="/editkegiatansawah/{{ $kegiatansawah->id }}" class="btn btn-sm btn-outline-primary mx-1">
                                <i class="menu-icon mdi mdi-pencil"></i> Edit
                            </a>
                            <form action="/deletekegiatansawah/{{ $kegiatansawah->id }}" method="POST" onsubmit="return confirm('Apakah Anda ingin menghapus data Kegiatan Penanaman Bawang ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger mx-1">
                                    <i class="menu-icon mdi mdi-delete"></i> Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </li>
        @endforeach
    </ul>
</div>

@endsection