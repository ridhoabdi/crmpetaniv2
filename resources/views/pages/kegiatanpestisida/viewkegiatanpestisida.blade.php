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
        <h5>Data Kegiatan Pestisida</h5>
        <a href="/addkegiatanpestisida" class="btn btn-sm btn-outline-success mt-1">
            <i class="menu-icon mdi mdi-plus"></i> Tambah data
        </a>
    </div>
    <ul class="list-group mt-3">
        @foreach ($kspestisidas as $kspestisida)
            <li class="list-group-item mt-3">
                <div class="row">
                    <div class="col-md-8">
                        <table>
                            <tr>
                                <th>Keterangan Lokasi Sawah</th>
                                <td>{{ $kspestisida->lokasisawah_keterangan}}</td>
                            </tr>
                            <tr>
                                <th>Kabupaten</th>
                                <td>{{ $kspestisida->kabupaten_nama }}</td>
                            </tr>
                            <tr>
                                <th>Waktu Tanam</th>
                                <td>{{ \Carbon\Carbon::parse($kspestisida->ks_waktu_tanam)->translatedFormat('l, d F Y') }}</td>
                            </tr>
                            <tr>
                                <th>Tanggal Semprot Pestisida</th>
                                <td>{{ \Carbon\Carbon::parse($kspestisida->ks_pestisida_tgl_semprot)->translatedFormat('l, d F Y') }}</td>
                            </tr>
                            <tr>
                                <th>Nama Pestisida</th>
                                <td>{{ $kspestisida->pestisida_nama}}</td>
                            </tr>
                            <tr>
                                <th>Jumlah Takaran Pestisida</th>
                                <td>{{ number_format($kspestisida->ks_pestisida_jumlah_takaran, 1) }} liter</td>
                            </tr>
                            <tr>
                                <th>Keterangan Kegiatan</th>
                                <td>{{ $kspestisida->ks_pestisida_keterangan ? $kspestisida->ks_pestisida_keterangan : '-' }}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-4">
                        <div class="d-flex justify-content-end">
                            <a href="/editkegiatanpestisida/{{ $kspestisida->id }}" class="btn btn-sm btn-outline-primary mx-1">
                                <i class="menu-icon mdi mdi-pencil"></i> Edit
                            </a>
                            <form action="/deletekegiatanpestisida/{{ $kspestisida->id }}" method="POST" onsubmit="return confirm('Apakah Anda ingin menghapus data Kegiatan Pestisida ini?')">
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