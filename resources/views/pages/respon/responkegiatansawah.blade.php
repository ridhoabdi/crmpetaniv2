@extends('layouts.mother')

@section('container')

<div class="row justify-content-center">
    <div class="col-8">
        <div class="card p-3 shadow-sm">
            <div class="card-header">
                <h5>Maaf, Anda belum mengisi data Kegiatan Penanaman Bawang</h5>
                <p>Silahkan mengisi data Kegiatan Penanaman Bawang terlebih dahulu agar dapat mengakses menu Kegiatan Pestisida dan Pupuk</p>
                <a href="/addkegiatansawah" class="btn btn-sm btn-outline-success mt-1">
                    <i class="menu-icon mdi mdi-plus"></i> Tambah data
                </a>
            </div>
        </div>
    </div>
</div>

@endsection