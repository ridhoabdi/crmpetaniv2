@extends('layouts.mother')

@section('container')

<div class="row justify-content-center">
    <div class="col-8">
        <div class="card p-3 shadow-sm">
            <div class="card-header">
                <h5>Maaf, Anda belum mengisi data Panen</h5>
                <p>Silahkan mengisi data Panen terlebih dahulu agar dapat mengakses menu Riwayat Panen</p>
                <a href="/viewpanen/" class="btn btn-sm btn-outline-success mt-1">
                    <i class="menu-icon mdi mdi-sack me-1"></i>  Menu Panen
                </a>
            </div>
        </div>
    </div>
</div>

@endsection