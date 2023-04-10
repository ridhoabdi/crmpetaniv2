@extends('layouts.mother')

@section('container')

<div class="row justify-content-center">
    <div class="col-8">
        <div class="card p-3 shadow-sm">
            <div class="card-header">
                <h5>Maaf, Anda belum mengisi data Kegiatan Pupuk</h5>
                <p>Silahkan mengisi data Kegiatan Pupuk terlebih dahulu agar dapat mengakses menu Panen</p>
                <a href="/addkegiatanpupuk" class="btn btn-sm btn-outline-success mt-1">
                    <i class="menu-icon mdi mdi-plus"></i> Tambah data
                </a>
            </div>
        </div>
    </div>
</div>

@endsection