@extends('layouts.mother')

@section('container')

<div class="card p-3 shadow-sm">
    <div class="card-header">
        <h5>Maaf, Anda belum mengisi data Lokasi Sawah</h5>
        <p>Silahkan mengisi data Lokasi Sawah terlebih dahulu agar dapat mengakses menu Kegiatan Penanaman Bawang</p>
        <a href="/addlokasisawah" class="btn btn-sm btn-outline-success mt-1">
            <i class="menu-icon mdi mdi-plus"></i> Tambah data
        </a>
    </div>
</div>

@endsection