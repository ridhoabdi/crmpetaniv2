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



<div class="row">
    <div class="col-8" style="background-color: #ffffff;">
        <div class="card-header mt-3">
            <h5 class="card-title mt-3">Data Profil</h5>
            <!-- <p class="mt-1">Bapak/Ibu dapat mengubah data profil dengan melakukan klik pada tombol Update Profil</p> -->
        </div>

        @foreach ($users as $user)
        <li class="list-group-item mt-3 mb-3">
            <div class="row">
                <div class="col-md-8">
                    <table>
                        <tr>
                            <th>Nama Petani</th>
                            <td>{{ $user->pemilik_nama }}</td>
                        </tr>
                        <tr>
                            <th>Jenis Kelamin</th>
                            <td>{{ $user->pemilik_jeniskelamin }}</td>
                        </tr>
                        <tr>
                            <th>Tanggal Lahir</th>
                            <td>{{ \Carbon\Carbon::parse($user->pemilik_tanggal_lahir)->translatedFormat('l, d F Y') }}</td>
                        </tr>
                        <tr>
                            <th>Nomor HP</th>
                            <td>{{ $user->pemilik_kontak }}</td>
                        </tr>
                        <tr>
                            <th>Pendidikan</th>
                            <td>{{ $user->pemilik_pendidikan }}</td>
                        </tr>
                        <tr>
                            <th>Tentang</th>
                            <td>{{ $user->pemilik_keterangan ?: '-' }}</td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-4">
                    <div class="d-flex justify-content-end">
                        <a href="#" class="btn btn-sm btn-outline-primary mx-1">
                            <i class="menu-icon mdi mdi-pencil"></i> Update
                        </a>
                    </div>
                </div>
            </div>
        </li>
        @endforeach
    </div>
</div>

@endsection