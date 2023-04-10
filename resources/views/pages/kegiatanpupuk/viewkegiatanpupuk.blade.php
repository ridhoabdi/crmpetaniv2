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
        <h5>Data Kegiatan Pupuk</h5>
        <a href="/addkegiatanpupuk" class="btn btn-sm btn-outline-success mt-1">
            <i class="menu-icon mdi mdi-plus"></i> Tambah data
        </a>
    </div>
    <ul class="list-group mt-3">
        @foreach ($kspupuks as $kspupuk)
            <li class="list-group-item mt-3">
                <div class="row">
                    <div class="col-md-8">
                        <table>
                            <tr>
                                <th style="width: 200px;">Waktu Tanam</th>
                                <td>{{ \Carbon\Carbon::parse($kspupuk->ks_waktu_tanam)->translatedFormat('l, d F Y') }}</td>
                            </tr>
                            <tr>
                                <th style="width: 200px;">Tanggal Rabuk Pupuk</th>
                                <td>{{ \Carbon\Carbon::parse($kspupuk->ks_pupuk_tgl_rabuk)->translatedFormat('l, d F Y') }}</td>
                            </tr>
                            <tr>
                                <th style="width: 200px;">Jenis Pupuk</th>
                                <td>{{ $kspupuk->jenispupuk_nama}}</td>
                            </tr>
                             <tr>
                                <th style="width: 200px;">Merk Pupuk</th>
                                <td>{{ $kspupuk->merkpupuk_nama}}</td>
                            </tr>
                            <tr>
                                <th style="width: 200px;">Jumlah Takaran Pupuk</th>
                                <td>{{ number_format($kspupuk->ks_pupuk_jumlah_takaran) }} liter</td>
                            </tr>
                            <tr>
                                <th style="width: 200px;">Keterangan Kegiatan</th>
                                <td>{{ $kspupuk->ks_pupuk_keterangan ? $kspupuk->ks_pupuk_keterangan : '-' }}</td>

                            </tr>
                            <tr>
                                <th style="width: 200px;">Kabupaten</th>
                                <td>{{ $kspupuk->kabupaten_nama }}</td>
                            </tr>
                            <tr>
                                <th style="width: 200px;">Alamat Lokasi Sawah</th>
                                <td>{{ $kspupuk->lokasisawah_keterangan}}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-4">
                        <div class="d-flex justify-content-end">
                            <a href="/editkegiatanpupuk/{{ $kspupuk->id }}" class="btn btn-sm btn-outline-primary mx-1">
                                <i class="menu-icon mdi mdi-pencil"></i> Edit
                            </a>
                            <form action="/deletekegiatanpupuk/{{ $kspupuk->id }}" method="POST" onsubmit="return confirm('Apakah Anda ingin menghapus data Kegiatan Pupuk ini?')">
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