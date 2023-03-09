@extends('layouts.mother')

@section('container')
    <div class="col-12 col-lg-6 grid-margin stretch-card">
        <a href="{{ url('pages/myprofile') }}" style="text-decoration: none; color:#000">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Profile Pengepul</h4>
                    <p>Lakukan Pendaftaran Terlebih Dahulu Disini jika belum daftar 
                    </p>
                </div>
            </div>
        </a>
    </div>
    <div class="col-12 col-lg-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Transaksi Jual</h4>
                <p>Halaman Transaksi Jual, Berisi data Perusahaan Yang Membutuhkan Produk Bawang Merah anda
                </p>
            </div>
        </div>
    </div>
    </div>
    <div class="row">
        <div class="col-12 col-lg-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Transaksi Beli</h4>
                    <p>
                      Proses Pembelian Produk Bawang Merah dari Petani
                    </p>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Proses</h4>
                    <p>Proses Memverifikasi Hasil Pembelian dari petani
                    </p>
                </div>
            </div>
        </div>
    </div>
    </div>
    <!-- content-wrapper ends -->
    <!-- partial:partials/_footer.html -->
      <!-- partial -->
    </div>
    <!-- main-panel ends -->
@endsection
