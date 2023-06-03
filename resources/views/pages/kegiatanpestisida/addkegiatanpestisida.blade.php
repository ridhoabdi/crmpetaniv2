@extends('layouts.mother')

@section('container')

<div class="row justify-content-center">
    <div class="col-8" style="background-color: #ffffff;">
        <div class="card-header mt-3">
            <a href="/viewkegiatanpestisida" class="btn btn-sm btn-outline-secondary mt-1">
                <i class="menu-icon mdi mdi-arrow-left"></i>
            </a>

            <h5 class="card-title mt-3">Form Tambah Data Kegiatan Pestisida</h5>
            <p class="mt-1">Berikut ini adalah formulir untuk menambahkan data kegiatan pupuk yang bertujuan untuk mengumpulkan informasi tentang kegiatan pupuk yang dilakukan. Mohon untuk melengkapi formulir di bawah ini agar sistem kami dapat memberikan rekomendasi terbaik dalam pertanian.</p>
        </div>

        <form action="/storekegiatanpestisida" method="POST">
            @csrf

            <!-- Alamat Lokasi Sawah -->
            <div class="form-group mt-3">
                <label for="lokasisawah_id">Keterangan Lokasi Sawah *</label>
                <select class="form-control form-control-lg  @error('lokasisawah_id') is-invalid @enderror" id="lokasisawah_id" name="lokasisawah_id">
                    <option selected disabled>--- pilih Keterangan Lokasi Sawah ---</option>
                    @foreach ($lokasisawahs as $lokasi)
                        <option value="{{ $lokasi->id }}">{{ $lokasi->lokasisawah_keterangan }}</option>
                    @endforeach
                </select>
                @error('lokasisawah_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Kabupaten -->
            <div class="form-group">
                <label for="lokasisawah_id">Kabupaten *</label>
                <select class="form-control form-control-lg @error('lokasisawah_id') is-invalid @enderror" id="lokasisawah_id" name="kabupaten_nama">
                    <option selected disabled>--- pilih Kabupaten ---</option>
                    @foreach ($lokasisawahs as $lokasi)
                        <option value="{{ $lokasi->id }}">{{ $lokasi->kabupaten_nama }}</option>
                    @endforeach
                </select>
                @error('lokasisawah_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Waktu Tanam -->
            <div class="form-group mt-3">
                <label for="kegiatansawah_id">Waktu Tanam *</label>
                <select class="form-control form-control-lg  @error('kegiatansawah_id') is-invalid @enderror" id="kegiatansawah_id" name="kegiatansawah_id">
                    <option selected disabled>--- pilih Waktu Tanam ---</option>
                    @foreach ($kegiatansawahs as $kegiatansawah)
                        <option value="{{ $kegiatansawah->id }}">{{ $kegiatansawah->ks_waktu_tanam }}</option>
                    @endforeach
                </select>
                @error('kegiatansawah_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Tanggal semprot pestisida -->
            <div class="form-group mt-3">
                <label for="ks_pestisida_tgl_semprot">Tanggal Semprot Pestisida *</label>

                <input type="date" name="ks_pestisida_tgl_semprot" class="form-control form-control-lg @error('ks_pestisida_tgl_semprot') is-invalid @enderror" id="ks_pestisida_tgl_semprot" placeholder=" ">

                @error('ks_pestisida_tgl_semprot')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <!-- Pestisida -->
            <div class="form-group">
                <label for="pestisida_id">Nama Pestisida *</label>
                <select name="pestisida_id" id="pestisida_id" class="form-control form-control-lg @error('pestisida_id') is-invalid @enderror">
                    <option selected disabled>--- pilih Pestisida ---</option>
                    @foreach ($pestisidas as $pestisida)
                        <option value="{{ $pestisida->id }}">{{ $pestisida->pestisida_nama }}</option>
                    @endforeach
                </select>
                @error('pestisida_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Jumlah Takaran Pestisida -->
            <div class="form-group">
                <label for="ks_pestisida_jumlah_takaran">Jumlah Takaran Pestisida *</label>

                <input type="number" step="0.01" name="ks_pestisida_jumlah_takaran" class="form-control form-control-lg @error('ks_pestisida_jumlah_takaran') is-invalid @enderror" value="{{ old('ks_pestisida_jumlah_takaran') }}">
                <div class="form-check">
                    <div class="">
                        <input class="inputan" type="radio" id="liter"
                            name="stnJumlahTakaranPestisida" value="Liter">
                        <label>Liter</label>
                    </div>
                    <div class="">
                        <input class="inputan" type="radio" id="mililiter"
                            name="stnJumlahTakaranPestisida" value="Mililiter">
                        <label>Mililiter</label>
                    </div>
                </div>

                @error('ks_pestisida_jumlah_takaran')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Keterangan Kegiatan Pestisida -->
            <div class="form-group">
                <label for="ks_pestisida_keterangan">Keterangan Kegiatan Pestisida</label>
                <textarea class="form-control form-control-lg" name="ks_pestisida_keterangan" id="ks_pestisida_keterangan" rows="3"></textarea>
            </div>
    
            <!-- Buttom Submit dan Cancel -->
            <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-success me-3">Submit</button>
                <button type="reset" class="btn btn-danger">Cancel</button>
            </div>
        </form>
    </div>
</div>

@endsection