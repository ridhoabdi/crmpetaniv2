@extends('layouts.mother')

@section('container')

<div class="row justify-content-center">
    <div class="col-8" style="background-color: #ffffff;">
        <div class="card-header mt-3">
            <a href="/viewkegiatansawah" class="btn btn-sm btn-outline-secondary mt-1">
                <i class="menu-icon mdi mdi-arrow-left"></i>
            </a>

            <h5 class="card-title mt-3">Form Tambah Data Kegiatan Penanaman Bawang</h5>
            <p class="mt-1">Formulir ini bertujuan untuk memulai aktivitas pertanian bawang merah Bapak/Ibu. Silakan melengkapi formulir di bawah ini agar sistem kami dapat memberikan rekomendasi terbaik untuk kegiatan pertanian Bapak/Ibu.</p>
        </div>

        <form action="/storekegiatansawah" method="POST">
            @csrf

            <!-- Keterangan Lokasi Sawah -->
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
                <label for="ks_waktu_tanam">Waktu Tanam *</label>

                <input type="date" name="ks_waktu_tanam" class="form-control form-control-lg @error('ks_waktu_tanam') is-invalid @enderror" id="ks_waktu_tanam" placeholder=" ">

                @error('ks_waktu_tanam')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <!-- Metode Pengairan -->
            <div class="form-group">
                <label for="ks_metode_pengairan">Metode Pengairan *</label>

                <div class="form-check @error('ks_metode_pengairan') is-invalid @enderror mt-1" value="{{ old('ks_metode_pengairan') }}">
                    <div class="">
                        <input class="" type="checkbox" name="ks_metode_pengairan[]" value="Sumur"> Sumur<br>
                    </div>
                    <div class="">
                        <input class="" type="checkbox" name="ks_metode_pengairan[]" value="Irigasi"> Irigasi<br>
                    </div>
                    <div class="">
                        <input class="" type="checkbox" name="ks_metode_pengairan[]" value="Tadah Hujan"> Tadah Hujan<br>
                    </div>
                    <div class="">
                        <input class="" type="checkbox" name="ks_metode_pengairan[]" value="Mata Air"> Mata Air<br>
                    </div>
                    <div class="">
                        <input class="" type="checkbox" name="ks_metode_pengairan[]" value="Sungai"> Sungai<br>
                    </div>
                </div>

                @error('ks_metode_pengairan')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <!-- Varietas Bawang -->
            <div class="form-group">
                <label for="varietasbawang_id">Varietas Bawang Merah *</label>

                <select name="varietasbawang_id" id="varietasbawang_id" class="form-control form-control-lg @error('varietasbawang_id') is-invalid @enderror">
                    <option selected disabled>--- pilih Varietas Bawang Merah yang digunakan ---</option>
                    @foreach ($varietasbawangs as $varietasbawang)
                        <option value="{{ $varietasbawang->id }}">{{ $varietasbawang->varietasbawang_nama }}</option>
                    @endforeach
                </select>

                @error('varietasbawang_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Jumlah Bibit -->
            <div class="form-group">
                <label for="ks_jumlah_bibit">Jumlah Bibit *</label>

                <input type="number" step="0.01" name="ks_jumlah_bibit" class="form-control form-control-lg @error('ks_jumlah_bibit') is-invalid @enderror" value="{{ old('ks_jumlah_bibit') }}">
                <div class="form-check">
                    <div class="">
                        <input class="inputan" type="radio" id="kilogram" name="stnBibit" value="Kilogram">
                        <label>Kilogram</label>
                    </div>
                    <div class="">
                        <input class="inputan" type="radio" id="kuintal" name="stnBibit" value="Kuintal">
                        <label>Kuintal</label>
                    </div>
                    <div class="">
                        <input class="inputan" type="radio" id="ton" name="stnBibit" value="Ton">
                        <label>Ton</label>
                    </div>
                </div>

                @error('ks_jumlah_bibit')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Luas Lahan -->
            <div class="form-group">
                <label for="ks_luas_lahan">Luas Lahan *</label>

                <input type="number" step="0.01" name="ks_luas_lahan" class="form-control form-control-lg @error('ks_luas_lahan') is-invalid @enderror" value="{{ old('ks_luas_lahan') }}">
                <div class="form-check">
                    <div class="">
                        <input class="inputan" type="radio" id="meter" name="stnLuasLahan" value="Meter">
                        <label>Meter</label>
                    </div>
                    <div class="">
                        <input class="inputan" type="radio" id="hektar" name="stnLuasLahan" value="Hektar">
                        <label>Hektar</label>
                    </div>
                </div>

                @error('ks_luas_lahan')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Status Lahan -->
            <div class="form-group">
                <label for="ks_status_lahan">Status Lahan *</label>

                <div class="form-check @error('ks_status_lahan') is-invalid @enderror mt-1" value="{{ old('ks_status_lahan') }}">
                    <div class="">
                        <input class="" type="checkbox" name="ks_status_lahan[]" value="Sewa"> Sewa<br>
                    </div>
                    <div class="">
                        <input class="" type="checkbox" name="ks_status_lahan[]" value="Milik Sendiri"> Milik Sendiri<br>
                    </div>
                    <div class="">
                        <input class="" type="checkbox" name="ks_status_lahan[]" value="Bagi Hasil"> Bagi Hasil<br>
                    </div>
                </div>

                @error('ks_status_lahan')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Sumber Modal -->
            <div class="form-group">
                <label for="ks_sumber_modal">Sumber Modal *</label>

                <div class="form-check @error('ks_sumber_modal') is-invalid @enderror mt-1" value="{{ old('ks_sumber_modal') }}">
                    <div class="">
                        <input class="" type="checkbox" name="ks_sumber_modal[]" value="Modal Sendiri"> Modal Sendiri<br>
                    </div>
                    <div class="">
                        <input class="" type="checkbox" name="ks_sumber_modal[]" value="Pinjam"> Pinjam<br>
                    </div>
                </div>

                @error('ks_sumber_modal')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Jumlah Modal -->
            <div class="form-group">
                <label for="ks_jumlah_modal">Jumlah Modal *</label>

                <input type="text" name="ks_jumlah_modal" id="rupiah" class="form-control form-control-lg @error('ks_jumlah_modal') is-invalid @enderror" value="{{ old('ks_jumlah_modal') }}">

                <script>
                    const rupiah = document.getElementById('rupiah');
                    rupiah.addEventListener('keyup', function(e) {
                        // format currency
                        let val = parseInt(this.value.replace(/[^0-9]/g, ''));
                        this.value = formatCurrency(val);
                    });

                    function formatCurrency(num) {
                        num = num.toString().replace(/\$|\,/g, '');
                        if (isNaN(num)) num = "0";
                        sign = (num == (num = Math.abs(num)));
                        num = Math.floor(num * 100 + 0.50000000001);
                        cents = num % 100;
                        num = Math.floor(num / 100).toString();
                        if (cents < 10) cents = "0" + cents;
                        for (var i = 0; i < Math.floor((num.length - (1 + i)) / 3); i++)
                        num = num.substring(0, num.length - (4 * i + 3)) +
                        '.' + num.substring(num.length - (4 * i + 3));
                        return (((sign) ? '' : '-') + 'Rp ' + num);
                    }
                </script>

                @error('ks_jumlah_modal')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- ks panen -->
            <div class="form-group">
                <input type="hidden" name="ks_panen" value="0">
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