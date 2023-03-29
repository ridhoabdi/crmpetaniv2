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
        <h5>Data Lokasi Sawah</h5>
        <a href="/addlokasisawah" class="btn btn-sm btn-outline-success mt-1">
            <i class="menu-icon mdi mdi-plus"></i> Tambah data
        </a>
    </div>
    <ul class="list-group mt-3">
        @foreach ($lokasisawahs as $lokasisawah)
            <li class="list-group-item mt-3">
                <div class="row">
                    <div class="col-md-8">
                        <table>
                            <tr>
                                <th style="width: 180px;">Latitude</th>
                                <td>{{ $lokasisawah->lokasisawah_latitude ? $lokasisawah->lokasisawah_latitude : '-' }}</td>
                            </tr>
                            <tr>
                                <th style="width: 180px;">Longitude</th>
                                <td>{{ $lokasisawah->lokasisawah_longitude ? $lokasisawah->lokasisawah_longitude : '-' }}</td>
                            </tr>
                            <tr>
                                <th style="width: 180px;">Kabupaten</th>
                                <td>{{ $lokasisawah->kabupaten_nama }}</td>
                            </tr>
                            <tr>
                                <th style="width: 180px;">Alamat Lokasi Sawah</th>
                                <td>{{ $lokasisawah->lokasisawah_keterangan ? $lokasisawah->lokasisawah_keterangan : '-' }}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-4">
                        <div class="d-flex justify-content-end">
                            <a href="/editlokasisawah/{{ $lokasisawah->id }}" class="btn btn-sm btn-outline-primary mx-1">
                                <i class="menu-icon mdi mdi-pencil"></i> Edit
                            </a>
                            <form action="/deletelokasisawah/{{ $lokasisawah->id }}" method="POST" onsubmit="return confirm('Apakah Anda ingin menghapus Lokasi Sawah ini?')">
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