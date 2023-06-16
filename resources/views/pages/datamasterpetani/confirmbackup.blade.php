@extends('layouts.mother')

@section('container')

<div class="row justify-content-center">
    <div class="col-7" style="background-color: #ffffff;">
        <div class="card-header mt-3">
            <a href="/viewpanen" class="btn btn-sm btn-outline-secondary mt-1">
                <i class="menu-icon mdi mdi-arrow-left"></i>
            </a>
            <h5 class="card-title mt-3">Konfirmasi Backup Data</h5>
            <p class="mt-1">Mohon klik tombol konfirmasi untuk mencadangkan data yang dihasilkan dari aktivitas penanaman bawang sampai dengan masa panen yang telah dilakukan oleh Bapak/Ibu.</p>
        </div>

        <form action="/storebackup" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- [Hidden : lokasisawah_id ] -->
            <div class="form-group mt-3">
                <input type="hidden" name="lokasisawah_id" id="lokasisawah_id" value="{{ $lokasisawahs->first()->id }}">
            </div>

            <!-- [Hidden : kegiatansawah_id ] -->
            <div class="form-group mt-3">
                <input type="hidden" name="kegiatansawah_id" id="kegiatansawah_id" value="{{ $kegiatansawahs->first()->id }}">
            </div>

            <!-- [Hidden : kspupuk_id ] -->
            <div class="form-group mt-3">
                <input type="hidden" name="kspupuk_id" id="kspupuk_id" value="{{ $kspupuks->first()->id }}">
            </div>

            <!-- [Hidden : kspestisida_id ] -->
            <div class="form-group mt-3">
                <input type="hidden" name="kspestisida_id" id="kspestisida_id" value="{{ $kspestisidas->first()->id }}">
            </div>

            <!-- [Hidden : panen_id ] -->
            <div class="form-group mt-3">
                <input type="hidden" name="id" id="id" value="{{ $panens->first()->id }}">
            </div>

            <!-- Buttom Submit dan Cancel -->
            <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-success me-3 mb-3">Konfirmasi</button>
            </div>
        </form>
    </div>
</div>

@endsection